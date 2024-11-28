<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class FacilityEntity extends Model
{
    protected $fillable = ['facility_id', 'entity_id', 'entity_type'];

    public function facility(): BelongsTo
    {
        return $this->belongsTo(Facility::class);
    }

    public function entity(): MorphTo
    {
        return $this->morphTo();
    }
}
