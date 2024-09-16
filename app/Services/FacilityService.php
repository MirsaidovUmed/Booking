<?php

namespace App\Services;

use App\Models\Facility;
use App\Models\FacilityEntity;
use App\Dto\FacilityDto;

class FacilityService
{
    public function create(FacilityDto $facilityDto)
    {
        $facility = Facility::firstOrCreate(['title' => $facilityDto->getTitle()]);

        FacilityEntity::create([
            'facility_id' => $facility->id,
            'entity_id' => $facilityDto->getEntityId(),
            'entity_type' => $facilityDto->getEntityType(),
        ]);

        return $facility;
    }

    public function update(FacilityDto $facilityDto, int $id)
    {
        $facility = Facility::findOrFail($id);
        $facility->update(['title' => $facilityDto->getTitle()]);

        FacilityEntity::where('facility_id', $facility->id)
            ->where('entity_id', $facilityDto->getEntityId())
            ->where('entity_type', $facilityDto->getEntityType())
            ->update([
                'entity_id' => $facilityDto->getEntityId(),
                'entity_type' => $facilityDto->getEntityType(),
            ]);

        return $facility;
    }

    public function delete(int $id)
    {
        Facility::findOrFail($id)->delete();
    }
}
