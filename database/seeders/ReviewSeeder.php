<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\Hotel;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $user = User::all();
        $hotel = Hotel::all();

        foreach (range(1, 10) as $index) {
            DB::table('reviews')->insert([
                'user_id' => $user->random()->id,
                'hotel_id' => $hotel->random()->id,
                'review' => $faker->text(255),
                'rating' => $faker->numberBetween(1, 5),
             ]);
        }
    }
}
