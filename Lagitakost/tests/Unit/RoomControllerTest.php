<?php

namespace Tests\Unit;

use App\Http\Controllers\RoomController;
use App\Models\Room;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class RoomControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_view_with_rooms()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        Auth::login($admin);

        Room::factory()->count(3)->create();

        $controller = new RoomController();
        $response = $controller->index();

        $this->assertEquals('rooms.index', $response->getName());
        $data = $response->getData();

        $this->assertArrayHasKey('rooms', $data);
        $this->assertCount(3, $data['rooms']);
    }

    public function test_create_returns_view()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        Auth::login($admin);

        $controller = new RoomController();
        $response = $controller->create();

        $this->assertEquals('rooms.create', $response->getName());
    }

    public function test_store_creates_room_with_valid_data()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        Auth::login($admin);

        $roomData = [
            'name' => 'Test Room 101',
            'type' => 'Tipe A',
            'price' => 500000,
            'capacity' => 2,
            'size' => '3×4m',
            'facilities' => ['WiFi', 'AC', 'Kamar Mandi Dalam'],
            'is_available' => true,
            'description' => 'Test room description'
        ];

        $controller = new RoomController();
        $response = $controller->store(request()->merge($roomData));

        $this->assertEquals(302, $response->getStatusCode()); // Redirect
        $this->assertDatabaseHas('rooms', [
            'name' => 'Test Room 101',
            'type' => 'Tipe A',
            'price' => 500000
        ]);
    }

    public function test_store_validation_fails_with_invalid_data()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        Auth::login($admin);

        $invalidData = [
            'name' => '', // Required field empty
            'type' => 'Invalid Type',
            'price' => -1000, // Invalid price
        ];

        $controller = new RoomController();

        try {
            $controller->store(request()->merge($invalidData));
            $this->fail('Expected validation exception');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->assertArrayHasKey('name', $e->errors());
            $this->assertArrayHasKey('price', $e->errors());
        }
    }

    public function test_show_returns_view_with_room()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        Auth::login($admin);

        $room = Room::factory()->create();

        $controller = new RoomController();
        $response = $controller->show($room->id);

        $this->assertEquals('rooms.show', $response->getName());
        $data = $response->getData();

        $this->assertArrayHasKey('room', $data);
        $this->assertEquals($room->id, $data['room']->id);
    }

    public function test_edit_returns_view_with_room()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        Auth::login($admin);

        $room = Room::factory()->create();

        $controller = new RoomController();
        $response = $controller->edit($room->id);

        $this->assertEquals('rooms.edit', $response->getName());
        $data = $response->getData();

        $this->assertArrayHasKey('room', $data);
        $this->assertEquals($room->id, $data['room']->id);
    }

    public function test_update_modifies_room_with_valid_data()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        Auth::login($admin);

        $room = Room::factory()->create([
            'name' => 'Original Name',
            'price' => 500000
        ]);

        $updateData = [
            'name' => 'Updated Name',
            'type' => 'Tipe B',
            'price' => 850000,
            'capacity' => 3,
            'size' => '4×5m',
            'facilities' => ['WiFi', 'AC'],
            'is_available' => false,
            'description' => 'Updated description'
        ];

        $controller = new RoomController();
        $response = $controller->update(request()->merge($updateData), $room->id);

        $this->assertEquals(302, $response->getStatusCode()); // Redirect
        $room->refresh();

        $this->assertEquals('Updated Name', $room->name);
        $this->assertEquals('Tipe B', $room->type);
        $this->assertEquals(850000, $room->price);
        $this->assertFalse($room->is_available);
    }

    public function test_destroy_deletes_room()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        Auth::login($admin);

        $room = Room::factory()->create();

        $controller = new RoomController();
        $response = $controller->destroy($room->id);

        $this->assertEquals(302, $response->getStatusCode()); // Redirect
        $this->assertDatabaseMissing('rooms', ['id' => $room->id]);
    }

    public function test_non_admin_cannot_access_index()
    {
        $user = User::factory()->create(['is_admin' => false]);

        $response = $this->actingAs($user)->get(route('rooms.index'));

        $response->assertStatus(403);
    }
}
