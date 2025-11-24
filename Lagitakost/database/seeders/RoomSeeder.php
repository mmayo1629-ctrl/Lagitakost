<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample rooms for each type
        $roomTypes = config('booking.room_types');

        foreach ($roomTypes as $type => $price) {
            // Create 5 rooms for each type to reach 30 total rooms (6 types × 5 = 30)
            $roomCount = 5;

            for ($i = 1; $i <= $roomCount; $i++) {
                Room::factory()->ofType($type)->create([
                    'name' => $type . ' - ' . str_pad($i, 3, '0', STR_PAD_LEFT),
                ]);
            }
        }
    }
}
