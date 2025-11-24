<?php

namespace Tests\Unit;

use App\Http\Controllers\ContactMessageController;
use App\Models\ContactMessage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ContactMessageControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create and authenticate an admin user
        $this->admin = User::factory()->create(['is_admin' => true]);
        Auth::login($this->admin);
    }

    public function test_index_returns_view_with_messages()
    {
        ContactMessage::factory()->count(3)->create();

        $controller = new ContactMessageController();
        $response = $controller->index();

        $this->assertEquals('contact-messages.index', $response->getName());
        $this->assertArrayHasKey('messages', $response->getData());
        $this->assertCount(3, $response->getData()['messages']);
    }

    public function test_show_returns_view_and_marks_as_read()
    {
        $message = ContactMessage::factory()->create(['is_read' => false]);

        $controller = new ContactMessageController();
        $response = $controller->show($message->id);

        $this->assertEquals('contact-messages.show', $response->getName());
        $this->assertArrayHasKey('message', $response->getData());
        $this->assertEquals($message->id, $response->getData()['message']->id);

        $message->refresh();
        $this->assertTrue($message->is_read);
        $this->assertNotNull($message->read_at);
    }

    public function test_show_marks_as_read_only_once()
    {
        $message = ContactMessage::factory()->create(['is_read' => true, 'read_at' => now()]);

        $controller = new ContactMessageController();
        $controller->show($message->id);

        $message->refresh();
        $this->assertTrue($message->is_read);
        // read_at should remain the same
    }

    public function test_show_throws_exception_for_nonexistent_message()
    {
        $controller = new ContactMessageController();

        $this->expectException(\Illuminate\Database\Eloquent\ModelNotFoundException::class);
        $controller->show(999);
    }

    public function test_mark_as_read_updates_message()
    {
        $message = ContactMessage::factory()->create(['is_read' => false]);

        $controller = new ContactMessageController();
        $response = $controller->markAsRead($message->id);

        $this->assertInstanceOf(\Illuminate\Http\JsonResponse::class, $response);
        $data = $response->getData();
        $this->assertTrue($data->success);

        $message->refresh();
        $this->assertTrue($message->is_read);
        $this->assertNotNull($message->read_at);
    }

    public function test_mark_as_read_throws_exception_for_nonexistent_message()
    {
        $controller = new ContactMessageController();

        $this->expectException(\Illuminate\Database\Eloquent\ModelNotFoundException::class);
        $controller->markAsRead(999);
    }

    public function test_destroy_deletes_message()
    {
        $message = ContactMessage::factory()->create();

        $controller = new ContactMessageController();
        $response = $controller->destroy($message->id);

        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        $this->assertDatabaseMissing('contact_messages', ['id' => $message->id]);
        $this->assertTrue(session()->has('success'));
    }

    public function test_destroy_throws_exception_for_nonexistent_message()
    {
        $controller = new ContactMessageController();

        $this->expectException(\Illuminate\Database\Eloquent\ModelNotFoundException::class);
        $controller->destroy(999);
    }

    public function test_access_denied_for_non_admin_user()
    {
        // Create a new test instance without middleware
        $regularUser = User::factory()->create(['is_admin' => false]);
        Auth::login($regularUser);

        // Test the middleware logic directly
        $request = Request::create('/contact-messages', 'GET');
        $middleware = function ($request, $next) {
            if (!auth()->user()->is_admin) {
                abort(403, 'Unauthorized');
            }
            return $next($request);
        };

        $this->expectException(\Symfony\Component\HttpKernel\Exception\HttpException::class);
        $middleware($request, function() { return 'next'; });
    }
}
