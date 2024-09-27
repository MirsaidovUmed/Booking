<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\Room;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        
        $users = User::all();
        $rooms = Room::all();
        
        if ($users->isEmpty() || $rooms->isEmpty()) {
            $this->command->info('Необходимо добавить пользователей и комнаты перед запуском BookingSeeder.');
            return;
        }
        
        foreach (range(1, 10) as $index) {
            DB::table('bookings')->insert([
                'room_id' => $rooms->random()->id,
                'user_id' => $users->random()->id,
                'started_at' => $faker->dateTimeBetween('-1 month', 'now'),
                'finished_at' => $faker->dateTimeBetween('now', '+1 month'),
                'days' => $faker->numberBetween(1, 14), // Количество дней бронирования
                'price' => $faker->randomFloat(2, 50, 500), // Цена за бронирование
            ]);
        }
    }
}
