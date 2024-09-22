<?php

namespace Tests\Feature;

use App\Models\Hotel;
use App\Models\Role;
use App\Models\Room;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class RoomTest extends TestCase
{
    use RefreshDatabase;
    
    public function setUp(): void
    {
        parent::setUp();
        DB::table('hotels');

        $this->artisan('db:seed', ['--class' => 'RoleSeeder']);
        $this->artisan('db:seed', ['--class' => 'HotelSeeder']);
        $this->artisan('db:seed', ['--class' => 'RoomSeeder']);
    }

    public function test_rooms_index()
    {
        $response = $this->get('/hotels');
        $response->assertStatus(200);
    }

    public function test_rooms_can_be_shown()
    {
        $room = Room::factory()->create();
        $response = $this->get('room/' . $room->id);
        $response->assertStatus(200);
    }

    public function test_room_can_be_created()
    {
        $role = Role::where('name', 'admin')->first();
    
        $user = User::factory()->create(['role_id' => $role->id]);
        $hotel = Hotel::factory()->create();

        $this->actingAs($user);

        $attributes = [
            'title' => 'new title',
            'description' => 'new description',
            'poster_url' => 'some_url.com',
            'floor_area' => 2.2,
            'type' => 'single',
            'price' => 100,
            'hotel_id' => $hotel->id,
        ];

        $response = $this->post('rooms' , $attributes);
        $response->assertStatus(201);

        $this->assertDatabaseHas('rooms', $attributes);
    }

    public function test_room_can_updated()
    {

        $role = Role::where('name', 'admin')->first();

        $user = User::factory()->create(['role_id' => $role->id]);
        $hotel = Hotel::factory()->create();

        $this->actingAs($user);

        $room = Room::factory()->create();

        $attributes = [
            'title' => 'new title',
            'description' => 'new description',
            'poster_url' => 'some_url.com',
            'floor_area' => 2.2,
            'type' => 'single',
            'price' => 100,
            'hotel_id' => $hotel->id,
        ];

        $response = $this->put('rooms/' . $room->getKey(), $attributes);
        $response->assertStatus(202);

        $this->assertDatabaseHas('rooms', array_merge(
            ['id' => $room->getKey()],
            $attributes
        ));
    }

    public function test_room_can_be_deleted()
    {
        $role = Role::where('name', 'admin')->first();

        $user = User::factory()->create(['role_id' => $role->id]);

        $this->actingAs($user);

        $room = Room::factory()->create();

        $response = $this->delete('rooms/' . $room->getKey());
        $response->assertStatus(204);

        $this->assertDatabaseMissing('rooms', ['id' => $room->getKey()],);
    }
}
