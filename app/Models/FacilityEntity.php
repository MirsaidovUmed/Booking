<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacilityEntity extends Model
{
    protected $fillable = ['facility_id', 'entity_id', 'entity_type'];

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }
}
