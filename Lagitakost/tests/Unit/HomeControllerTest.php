<?php

namespace Tests\Unit;

use App\Http\Controllers\HomeController;
use App\Models\Booking;
use App\Models\ContactMessage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_owner_dashboard_for_admin_user()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        Auth::login($admin);

        // Create test data
        ContactMessage::factory()->count(3)->create();
        ContactMessage::factory()->create(['is_read' => false]);
        Booking::factory()->create(['status' => 'confirmed', 'price' => 500000]);
        Booking::factory()->create(['status' => 'confirmed', 'price' => 300000]);

        $controller = new HomeController();
        $response = $controller->index();

        $this->assertEquals('owner-dashboard', $response->getName());
        $data = $response->getData();

        $this->assertArrayHasKey('contactMessages', $data);
        $this->assertArrayHasKey('unreadCount', $data);
        $this->assertArrayHasKey('recentBookings', $data);
        $this->assertArrayHasKey('totalRevenue', $data);
        $this->assertArrayHasKey('monthlyBookings', $data);
        $this->assertArrayHasKey('pendingPayments', $data);

        $this->assertCount(4, $data['contactMessages']); // Latest 4 (3 read + 1 unread)
        $this->assertEquals(2, $data['unreadCount']); // 1 unread message
        $this->assertCount(2, $data['recentBookings']); // Latest 2 bookings
        $this->assertEquals(800000, $data['totalRevenue']); // 500k + 300k
        $this->assertEquals(2, $data['monthlyBookings']); // 2 confirmed bookings
    }

    public function test_index_returns_customer_dashboard_for_regular_user()
    {
        $user = User::factory()->create(['is_admin' => false]);
        Auth::login($user);

        // Create bookings for the user
        Booking::factory()->create(['user_id' => $user->id, 'status' => 'confirmed']);
        Booking::factory()->create(['user_id' => $user->id, 'status' => 'pending']);
        // Create booking for another user
        Booking::factory()->create(['status' => 'confirmed', 'notification_read' => false]);

        $controller = new HomeController();
        $response = $controller->index();

        $this->assertEquals('home', $response->getName());
        $data = $response->getData();

        $this->assertArrayHasKey('notificationCount', $data);
        $this->assertEquals(0, $data['notificationCount']); // 0 unread notifications for this user (the confirmed booking is for another user)
    }

    public function test_customer_dashboard_returns_user_bookings()
    {
        $user = User::factory()->create();
        Auth::login($user);

        // Create bookings for the user
        Booking::factory()->create(['user_id' => $user->id]);
        Booking::factory()->create(['user_id' => $user->id]);
        // Create booking for another user
        Booking::factory()->create();

        $controller = new HomeController();
        $response = $controller->customerDashboard();

        $this->assertEquals('customer-dashboard', $response->getName());
        $data = $response->getData();

        $this->assertArrayHasKey('bookings', $data);
        $this->assertCount(2, $data['bookings']); // Only user's bookings
    }

    public function test_index_calculates_correct_notification_count_for_customer()
    {
        $user = User::factory()->create();
        Auth::login($user);

        // Create various booking statuses
        Booking::factory()->create([
            'user_id' => $user->id,
            'status' => 'confirmed',
            'notification_read' => false
        ]);
        Booking::factory()->create([
            'user_id' => $user->id,
            'status' => 'cancelled',
            'notification_read' => false
        ]);
        Booking::factory()->create([
            'user_id' => $user->id,
            'status' => 'pending',
            'notification_read' => false
        ]); // Should not count pending
        Booking::factory()->create([
            'user_id' => $user->id,
            'status' => 'confirmed',
            'notification_read' => true
        ]); // Already read

        $controller = new HomeController();
        $response = $controller->index();

        $data = $response->getData();
        $this->assertEquals(2, $data['notificationCount']); // confirmed and cancelled unread
    }

    public function test_owner_dashboard_shows_correct_unread_message_count()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        Auth::login($admin);

        ContactMessage::factory()->create(['is_read' => false]);
        ContactMessage::factory()->create(['is_read' => false]);
        ContactMessage::factory()->create(['is_read' => true]);

        $controller = new HomeController();
        $response = $controller->index();

        $data = $response->getData();
        $this->assertEquals(2, $data['unreadCount']);
    }
}
