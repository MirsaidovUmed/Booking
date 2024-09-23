<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class BookingTest extends TestCase
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

    public function test_bookings_index()
    {
        $response = $this->get('/bookings');
        $response->assertStatus(200);
    }

    public function test_booking_can_be_created()
    {
        $user = User::factory()->create(['email' => 'umedmirsaidov61+' . uniqid() . '@gmail.com']);
        var_dump($user);
        $room = Room::factory()->create();

        $this->actingAs($user);

        $startedAt = now();
        $finishedAt = now()->addDays(3);
        $days = $finishedAt->diffInDays($startedAt);
        $price = $room->price * $days;

        $attributes = [
            'room_id' => $room->id,
            'user_id' => $user->id,
            'started_at' => $startedAt,
            'finished_at' => $finishedAt,
            'days' => $days,
            'price' => $price,
        ];

        $response = $this->post('bookings', $attributes);

        $response->assertStatus(201);

        $this->assertDatabaseHas('bookings', $attributes);
    }

    public function test_booking_can_be_updated()
    {
        $user = User::factory()->create(['email' => 'umedmirsaidov61+' . uniqid() . '@gmail.com']);
        $room = Room::factory()->create();

        $this->actingAs($user);

        $booking = Booking::factory()->create(['user_id' => $user->id]);

        $startedAt = now();
        $finishedAt = now()->addDays(3);
        $days = $finishedAt->diffInDays($startedAt);
        $price = $room->price * $days;

        $attributes = [
            'room_id' => $room->id,
            'user_id' => $user->id,
            'started_at' => $startedAt,
            'finished_at' => $finishedAt,
            'days' => $days,
            'price' => $price,
        ];

        $response = $this->put('bookings/' . $booking->getKey(), $attributes);
        
        $response->assertStatus(202);

        $this->assertDatabaseHas('bookings', $attributes);
    }

    public function test_booking_can_be_deleted()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $booking = Booking::factory()->create();

        $response = $this->delete('bookings/' . $booking->getKey());
        $response->assertStatus(204);

        $this->assertDatabaseMissing('bookings', ['id' => $booking->getKey()],);
    }
}
