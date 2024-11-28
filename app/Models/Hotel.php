<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'poster_url',
        'address',
        'price',
    ];

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function facilities(): MorphMany
    {
        return $this->morphMany(FacilityEntity::class, 'entity');
    }
}
