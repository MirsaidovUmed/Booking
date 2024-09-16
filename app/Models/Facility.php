<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $fillable = ['title'];

    public function entities()
    {
        return $this->hasMany(FacilityEntity::class);
    }
}
