<?php

namespace Tests\Unit;

use App\Http\Controllers\BookingController;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class BookingControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a user for testing
        $this->user = User::factory()->create();
        Auth::login($this->user);
    }

    public function test_store_creates_booking_with_valid_data()
    {
        // Arrange
        $controller = new BookingController();
        $request = Request::create('/bookings', 'POST', [
            'room_type' => 'Tipe A',
            'check_in_date' => now()->addDay()->format('Y-m-d'),
            'check_out_date' => now()->addDays(3)->format('Y-m-d'),
            'notes' => 'Test booking'
        ]);

        // Act
        $response = $controller->store($request);

        // Assert
        $this->assertDatabaseHas('bookings', [
            'user_id' => $this->user->id,
            'room_type' => 'Tipe A',
            'status' => 'pending',
            'notes' => 'Test booking'
        ]);

        $booking = Booking::where('user_id', $this->user->id)->first();
        $this->assertNotNull($booking);
        $expectedPrice = Booking::calculatePrice('Tipe A', $request->check_in_date, $request->check_out_date);
        $this->assertEqualsWithDelta($expectedPrice, $booking->price, 0.01);
    }

    public function test_store_returns_json_response_when_expected()
    {
        // Arrange
        $controller = new BookingController();
        $checkIn = now()->addDay()->format('Y-m-d');
        $checkOut = now()->addDays(3)->format('Y-m-d'); // 2 days stay
        $request = Request::create('/bookings', 'POST', [
            'room_type' => 'Tipe B',
            'check_in_date' => $checkIn,
            'check_out_date' => $checkOut,
            'notes' => 'JSON test'
        ], [], [], ['HTTP_Accept' => 'application/json']);

        // Act
        $response = $controller->store($request);

        // Assert
        $this->assertInstanceOf(\Illuminate\Http\JsonResponse::class, $response);
        $data = $response->getData();
        $this->assertTrue($data->success);
        $this->assertEquals('Booking berhasil dibuat! Kami akan segera memproses permintaan Anda.', $data->message);
        $this->assertEquals(2, $data->days); // 3-1=2 days
    }

    public function test_store_validation_fails_with_invalid_data()
    {
        // Arrange
        $controller = new BookingController();
        $request = Request::create('/bookings', 'POST', [
            'room_type' => '',
            'check_in_date' => 'invalid-date',
            'check_out_date' => now()->subDay()->format('Y-m-d'),
        ]);

        // Act & Assert
        $this->expectException(\Illuminate\Validation\ValidationException::class);
        $controller->store($request);
    }

    public function test_update_status_updates_booking_and_resets_notification()
    {
        // Arrange
        $booking = new Booking([
            'id' => 1,
            'user_id' => $this->user->id,
            'room_type' => 'Tipe A',
            'check_in_date' => now()->addDay()->format('Y-m-d'),
            'check_out_date' => now()->addDays(3)->format('Y-m-d'),
            'status' => 'pending',
            'notification_read' => true,
            'notes' => 'Test',
            'price' => 100000
        ]);
        $booking->save();
        $controller = new BookingController();
        $request = Request::create("/bookings/{$booking->id}/status", 'PATCH', [
            'status' => 'confirmed'
        ]);

        // Act
        $response = $controller->updateStatus($request, $booking);

        // Assert
        $booking->refresh();
        $this->assertEquals('confirmed', $booking->status);
        $this->assertFalse($booking->notification_read);
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
    }

    public function test_update_status_validation_fails_with_invalid_status()
    {
        // Arrange
        $booking = new Booking([
            'id' => 2,
            'user_id' => $this->user->id,
            'room_type' => 'Tipe A',
            'check_in_date' => now()->addDay()->format('Y-m-d'),
            'check_out_date' => now()->addDays(3)->format('Y-m-d'),
            'status' => 'pending',
            'notification_read' => false,
            'notes' => 'Test',
            'price' => 100000
        ]);
        $booking->save();
        $controller = new BookingController();
        $request = Request::create("/bookings/{$booking->id}/status", 'PATCH', [
            'status' => 'invalid_status'
        ]);

        // Act & Assert
        $this->expectException(\Illuminate\Validation\ValidationException::class);
        $controller->updateStatus($request, $booking);
    }

    public function test_mark_notification_read_updates_booking_for_owner()
    {
        // Arrange
        $booking = new Booking([
            'id' => 3,
            'user_id' => $this->user->id,
            'room_type' => 'Tipe A',
            'check_in_date' => now()->addDay()->format('Y-m-d'),
            'check_out_date' => now()->addDays(3)->format('Y-m-d'),
            'status' => 'pending',
            'notification_read' => false,
            'notes' => 'Test',
            'price' => 100000
        ]);
        $booking->save();
        $controller = new BookingController();
        $request = Request::create("/bookings/{$booking->id}/mark-read", 'PATCH');

        // Act
        $response = $controller->markNotificationRead($request, $booking);

        // Assert
        $booking->refresh();
        $this->assertTrue($booking->notification_read);
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
    }

    public function test_mark_notification_read_forbidden_for_non_owner()
    {
        // Arrange
        $otherUser = User::factory()->create();
        $booking = new Booking([
            'id' => 4,
            'user_id' => $otherUser->id,
            'room_type' => 'Tipe A',
            'check_in_date' => now()->addDay()->format('Y-m-d'),
            'check_out_date' => now()->addDays(3)->format('Y-m-d'),
            'status' => 'pending',
            'notification_read' => false,
            'notes' => 'Test',
            'price' => 100000
        ]);
        $booking->save();
        $controller = new BookingController();
        $request = Request::create("/bookings/{$booking->id}/mark-read", 'PATCH');

        // Act & Assert
        $this->expectException(\Symfony\Component\HttpKernel\Exception\HttpException::class);
        $controller->markNotificationRead($request, $booking);
    }
}
