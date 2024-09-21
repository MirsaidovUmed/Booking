<?php

namespace Tests\Feature\Hotel;

use App\Models\Hotel;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class HotelTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        DB::table('hotels');

        $this->artisan('db:seed', ['--class' => 'RoleSeeder']);
        $this->artisan('db:seed', ['--class' => 'HotelSeeder']);
    }

    public function test_hotels_index()
    {
        $response = $this->get('/hotels');
        $response->assertStatus(200);
    }

    public function test_hotels_can_be_shown()
    {
        $hotel = Hotel::factory()->create();
        $response = $this->get('hotels/' . $hotel->getKey());
        $response->assertStatus(200);
    }

    public function test_hotel_can_be_created()
    {
        $role = Role::where('name', 'admin')->first();
    
        $user = User::factory()->create(['role_id' => $role->id]);

        $this->actingAs($user);

        $attributes = [
            'title' => 'new title',
            'description' => 'new description',
            'poster_url' => 'some_url.com',
            'address' => 'Ryan Gosling street',
        ];

        $response = $this->post('hotels' , $attributes);
        $response->assertStatus(201);

        $this->assertDatabaseHas('hotels', $attributes);
    }

    public function test_hotel_can_be_updated()
    {

        $role = Role::where('name', 'admin')->first();

        $user = User::factory()->create(['role_id' => $role->id]);

        $this->actingAs($user);

        $hotel = Hotel::factory()->create();

        $attributes = [
            'title' => 'New Hotel',
            'address' => 'New address',
        ];

        $response = $this->put('hotels/' . $hotel->getKey(), $attributes);
        $response->assertStatus(202);

        $this->assertDatabaseHas('hotels', array_merge(
            ['id' => $hotel->getKey()],
            $attributes
        ));
    }

    public function test_hotel_can_updated_with_all_data()
    {

        $role = Role::where('name', 'admin')->first();

        $user = User::factory()->create(['role_id' => $role->id]);

        $this->actingAs($user);

        $hotel = Hotel::factory()->create();

        $attributes = [
            'title' => 'title',
            'description' => 'description',
            'poster_url' => 'some_url.com',
            'address' => 'Ryan Gosling street',
        ];
        $response = $this->put('hotels/' . $hotel->getKey(), $attributes);
        $response->assertStatus(202);

        $this->assertDatabaseHas('hotels', array_merge(
            ['id' => $hotel->getKey()],
            $attributes
        ));
    }

    public function test_hotel_can_be_deleted()
    {
        $role = Role::where('name', 'admin')->first();

        $user = User::factory()->create(['role_id' => $role->id]);

        $this->actingAs($user);

        $hotel = Hotel::factory()->create();

        $response = $this->delete('hotels/' . $hotel->getKey());
        $response->assertStatus(204);

        $this->assertDatabaseMissing('hotels', ['id' => $hotel->getKey()],);
    }
}
