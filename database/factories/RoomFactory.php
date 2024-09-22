<?php

namespace Database\Factories;

use App\Models\Hotel;
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
        return [
            'title' => $this->faker->company,
            'description' => $this->faker->text(200),
            'poster_url' => $this->faker->imageUrl(640, 480, 'hotels'),
            'floor_area' => $this->faker->randomFloat(2, 10, 500),
            'type' => $this->faker->company,
            'price' => $this->faker->randomNumber(3),
            'hotel_id' => Hotel::factory(),
        ];
    }
}
