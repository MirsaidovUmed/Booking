<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function facilities()
    {
        return $this->morphMany(FacilityEntity::class, 'entity');
    }
}
