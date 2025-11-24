<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'room_type' => $this->faker->randomElement(['Tipe A', 'Tipe B', 'Tipe C', 'Tipe D', 'Tipe E', 'Tipe F', 'Kamar Studio', 'Kamar Economy']),
            'check_in_date' => $this->faker->dateTimeBetween('now', '+30 days')->format('Y-m-d'),
            'check_out_date' => $this->faker->dateTimeBetween('+31 days', '+60 days')->format('Y-m-d'),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'cancelled']),
            'notes' => $this->faker->optional()->sentence(),
            'notification_read' => $this->faker->boolean(),
            'price' => $this->faker->numberBetween(100000, 1000000),
        ];
    }
}
