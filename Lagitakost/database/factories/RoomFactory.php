<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $roomTypes = config('booking.room_types');
        $type = $this->faker->randomElement(array_keys($roomTypes));
        $facilities = ['WiFi', 'AC', 'Kamar Mandi Dalam', 'TV', 'Lemari', 'Meja Belajar', 'Kasur', 'Kulkas', 'Dapur', 'Parkir'];

        return [
            'name' => $type . ' - ' . $this->faker->numberBetween(101, 999),
            'type' => $type,
            'price' => $roomTypes[$type],
            'capacity' => $this->faker->numberBetween(1, 4),
            'size' => $this->faker->numberBetween(2, 5) . '×' . $this->faker->numberBetween(3, 6) . 'm',
            'facilities' => json_encode($this->faker->randomElements($facilities, $this->faker->numberBetween(3, 8))),
            'is_available' => $this->faker->boolean(80), // 80% chance of being available
            'description' => $this->faker->optional(0.7)->paragraph(),
        ];
    }

    /**
     * Indicate that the room is available.
     */
    public function available(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_available' => true,
        ]);
    }

    /**
     * Indicate that the room is unavailable.
     */
    public function unavailable(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_available' => false,
        ]);
    }

    /**
     * Create a room of a specific type.
     */
    public function ofType(string $type): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => $type,
            'price' => config('booking.room_types')[$type] ?? 500000,
        ]);
    }
}
