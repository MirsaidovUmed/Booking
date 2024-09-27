<?php

namespace Database\Seeders;

use App\Models\FacilityEntity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacilityEntitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $facilityEntities = [
            ['facility_id' => 1, 'entity_id' => 1, 'entity_type' => 'App\Models\Room'],  // Wi-Fi для комнаты
            ['facility_id' => 2, 'entity_id' => 1, 'entity_type' => 'App\Models\Room'],  // Кондиционер для комнаты
            ['facility_id' => 3, 'entity_id' => 2, 'entity_type' => 'App\Models\Hotel'], // Бассейн для отеля
            ['facility_id' => 4, 'entity_id' => 2, 'entity_type' => 'App\Models\Hotel'], // Парковка для отеля
            ['facility_id' => 5, 'entity_id' => 3, 'entity_type' => 'App\Models\Room'],  // Сауна для комнаты
            ['facility_id' => 6, 'entity_id' => 2, 'entity_type' => 'App\Models\Hotel'], // Завтрак для отеля
        ];

        foreach ($facilityEntities as $facilityEntity) {
            FacilityEntity::create($facilityEntity);
        }
    }
}
