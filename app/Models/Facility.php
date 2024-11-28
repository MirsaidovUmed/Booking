<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Facility extends Model
{
    protected $fillable = ['title'];

    public function entities(): HasMany
    {
        return $this->hasMany(FacilityEntity::class);
    }
}
