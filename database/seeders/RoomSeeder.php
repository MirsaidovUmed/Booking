<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        DB::table('rooms')->insert([
            'title' => $faker->company,
            'description' => $faker->text(200),
            'poster_url' => $faker->imageUrl(640, 480, 'rooms'),
            'floor_area' => $faker->randomFloat(2, 15, 50),
            'type' => $faker->randomElement(['single', 'double', 'suite']),
            'price' => $faker->numberBetween(100, 10000),
            'hotel_id' => DB::table('hotels')->inRandomOrder()->first()->id,
        ]);
    }
}
