<?php

namespace Tests\Unit;

use App\Http\Controllers\FinancialReportController;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class FinancialReportControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create and authenticate a user
        $this->user = User::factory()->create();
        Auth::login($this->user);
    }

    public function test_index_returns_view_with_correct_data()
    {
        // Create confirmed bookings for current month
        Booking::factory()->create([
            'status' => 'confirmed',
            'price' => 500000,
            'created_at' => now(),
        ]);
        Booking::factory()->create([
            'status' => 'confirmed',
            'price' => 300000,
            'created_at' => now(),
        ]);

        // Create pending booking
        Booking::factory()->create([
            'status' => 'pending',
            'price' => 200000,
            'created_at' => now(),
        ]);

        $controller = new FinancialReportController();
        $response = $controller->index();

        $this->assertEquals('financial-report', $response->getName());
        $data = $response->getData();

        $this->assertEquals(800000, $data['totalRevenue']); // 500k + 300k
        $this->assertEquals(2, $data['monthlyBookings']); // 2 confirmed bookings
        $this->assertEquals(2, $data['pendingPayments']); // 2 confirmed bookings with price > 0
        $this->assertEquals(400000, $data['averageRevenuePerBooking']); // 800k / 2
        $this->assertCount(6, $data['monthlyRevenue']); // 6 months of data
    }

    public function test_index_calculates_zero_revenue_when_no_confirmed_bookings()
    {
        // Create only pending bookings
        Booking::factory()->create(['status' => 'pending', 'price' => 100000]);

        $controller = new FinancialReportController();
        $response = $controller->index();

        $data = $response->getData();
        $this->assertEquals(0, $data['totalRevenue']);
        $this->assertEquals(0, $data['monthlyBookings']);
        $this->assertEquals(0, $data['averageRevenuePerBooking']);
    }

    public function test_index_excludes_bookings_from_other_months()
    {
        // Create booking for current month
        Booking::factory()->create([
            'status' => 'confirmed',
            'price' => 500000,
            'created_at' => now(),
        ]);

        // Create booking for previous month
        Booking::factory()->create([
            'status' => 'confirmed',
            'price' => 300000,
            'created_at' => now()->subMonth(),
        ]);

        $controller = new FinancialReportController();
        $response = $controller->index();

        $data = $response->getData();
        $this->assertEquals(500000, $data['totalRevenue']); // Only current month
    }

    public function test_index_calculates_monthly_revenue_for_six_months()
    {
        $controller = new FinancialReportController();
        $response = $controller->index();

        $data = $response->getData();
        $this->assertCount(6, $data['monthlyRevenue']);

        // Check that each month has the correct structure
        foreach ($data['monthlyRevenue'] as $monthData) {
            $this->assertArrayHasKey('month', $monthData);
            $this->assertArrayHasKey('revenue', $monthData);
            $this->assertIsString($monthData['month']);
            $this->assertIsNumeric($monthData['revenue']);
        }
    }

    public function test_index_handles_division_by_zero_for_average_revenue()
    {
        // No bookings at all
        $controller = new FinancialReportController();
        $response = $controller->index();

        $data = $response->getData();
        $this->assertEquals(0, $data['averageRevenuePerBooking']);
    }
}
