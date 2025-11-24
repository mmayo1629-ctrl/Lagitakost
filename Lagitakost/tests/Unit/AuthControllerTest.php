<?php

namespace Tests\Unit;

use App\Http\Controllers\AuthController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_login_form_returns_view()
    {
        $controller = new AuthController();
        $response = $controller->showLoginForm();

        $this->assertEquals('auth.login', $response->getName());
    }

    public function test_login_with_valid_credentials()
    {
        $user = User::factory()->create([
            'password' => Hash::make('password123'),
        ]);

        $controller = new AuthController();
        $request = Request::create('/login', 'POST', [
            'email' => $user->email,
            'password' => 'password123',
        ]);
        // Set up session for the request
        $request->setLaravelSession(app('session')->driver());

        $response = $controller->login($request);

        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        $this->assertStringEndsWith('/home', $response->getTargetUrl());
    }

    public function test_login_with_invalid_credentials()
    {
        $user = User::factory()->create([
            'password' => Hash::make('password123'),
        ]);

        $controller = new AuthController();
        $request = Request::create('/login', 'POST', [
            'email' => $user->email,
            'password' => 'wrongpassword',
        ]);

        $response = $controller->login($request);

        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        $this->assertFalse(Auth::check());
        $this->assertTrue(session()->has('errors'));
    }

    public function test_show_register_form_returns_view()
    {
        $controller = new AuthController();
        $response = $controller->showRegisterForm();

        $this->assertEquals('auth.register', $response->getName());
    }

    public function test_register_with_valid_data()
    {
        $controller = new AuthController();
        $request = Request::create('/register', 'POST', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response = $controller->register($request);

        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        $this->assertStringEndsWith('/login', $response->getTargetUrl());
        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $this->assertTrue(session()->has('success'));
    }

    public function test_register_validation_fails_with_invalid_data()
    {
        $controller = new AuthController();
        $request = Request::create('/register', 'POST', [
            'name' => '',
            'email' => 'invalid-email',
            'password' => '123',
            'password_confirmation' => '456',
        ]);

        $this->expectException(\Illuminate\Validation\ValidationException::class);
        $controller->register($request);
    }

    public function test_logout()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $controller = new AuthController();
        $request = Request::create('/logout', 'POST');
        // Set up session for the request
        $request->setLaravelSession(app('session')->driver());

        $response = $controller->logout($request);

        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        $this->assertStringEndsWith('/login', $response->getTargetUrl());
        $this->assertFalse(Auth::check());
    }
}
