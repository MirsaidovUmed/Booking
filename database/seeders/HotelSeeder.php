<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        
        DB::table('hotels')->insert([
            'title' => $faker->company,
            'description' => $faker->text(200),
            'poster_url' => $faker->imageUrl(640, 480, 'hotels'),
            'address' => $faker->address,
            'price' => $faker->numberBetween(1, 10000),
        ]);
    }
}
