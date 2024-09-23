<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startedAt = Carbon::now();
        $finishedAt = Carbon::now()->addDays($this->faker->numberBetween(1, 14));
        $days = $finishedAt->diffInDays($startedAt);
        return [
            'room_id' => Room::factory(),
            'user_id' => User::factory(),
            'started_at' => $startedAt,
            'finished_at' => $finishedAt,
            'days' => $days,
            'price' => $this->faker->numberBetween(1000, 10000) * $days,
        ];
    }
}
