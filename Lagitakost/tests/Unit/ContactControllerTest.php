<?php

namespace Tests\Unit;

use App\Http\Controllers\ContactController;
use App\Models\ContactMessage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ContactControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create and authenticate a user
        $this->user = User::factory()->create();
        Auth::login($this->user);
    }

    public function test_send_creates_contact_message_with_valid_data()
    {
        $controller = new ContactController();
        $request = Request::create('/contact/send', 'POST', [
            'name' => 'John Doe',
            'phone' => '081234567890',
            'email' => 'john@example.com',
            'subject' => 'Test Subject',
            'message' => 'This is a test message',
        ]);

        $response = $controller->send($request);

        $this->assertInstanceOf(\Illuminate\Http\JsonResponse::class, $response);
        $data = $response->getData();
        $this->assertTrue($data->success);
        $this->assertEquals('Pesan berhasil dikirim! Kami akan segera menghubungi Anda.', $data->message);

        $this->assertDatabaseHas('contact_messages', [
            'name' => 'John Doe',
            'phone' => '081234567890',
            'email' => 'john@example.com',
            'subject' => 'Test Subject',
            'message' => 'This is a test message',
            'is_read' => false,
        ]);
    }

    public function test_send_validation_fails_with_invalid_data()
    {
        $controller = new ContactController();
        $request = Request::create('/contact/send', 'POST', [
            'name' => '',
            'phone' => '',
            'email' => 'invalid-email',
            'subject' => '',
            'message' => '',
        ]);

        $this->expectException(\Illuminate\Validation\ValidationException::class);
        $controller->send($request);
    }

    public function test_send_validation_fails_with_missing_required_fields()
    {
        $controller = new ContactController();
        $request = Request::create('/contact/send', 'POST', [
            'name' => 'John Doe',
            // Missing phone, email, subject, message
        ]);

        $this->expectException(\Illuminate\Validation\ValidationException::class);
        $controller->send($request);
    }

    public function test_send_validation_fails_with_invalid_email()
    {
        $controller = new ContactController();
        $request = Request::create('/contact/send', 'POST', [
            'name' => 'John Doe',
            'phone' => '081234567890',
            'email' => 'not-an-email',
            'subject' => 'Test Subject',
            'message' => 'This is a test message',
        ]);

        $this->expectException(\Illuminate\Validation\ValidationException::class);
        $controller->send($request);
    }

    public function test_send_validation_fails_with_message_too_long()
    {
        $controller = new ContactController();
        $request = Request::create('/contact/send', 'POST', [
            'name' => 'John Doe',
            'phone' => '081234567890',
            'email' => 'john@example.com',
            'subject' => 'Test Subject',
            'message' => str_repeat('a', 1001), // Exceeds 1000 characters
        ]);

        $this->expectException(\Illuminate\Validation\ValidationException::class);
        $controller->send($request);
    }
}
