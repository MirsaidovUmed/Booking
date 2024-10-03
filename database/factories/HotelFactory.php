<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotel>
 */
class HotelFactory extends Factory
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
            'address' => $this->faker->address,
            'price' => $this->faker->randomFloat(5, 1, 10000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
