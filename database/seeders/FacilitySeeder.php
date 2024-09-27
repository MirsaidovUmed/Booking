<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $facilities = [
            ['title' => 'Wi-Fi'],
            ['title' => 'Кондиционер'],
            ['title' => 'Бассейн'],
            ['title' => 'Парковка'],
            ['title' => 'Сауна'],
            ['title' => 'Завтрак включен']
        ];

        foreach ($facilities as $facility) {
            Facility::create($facility);
        }
    }
}
