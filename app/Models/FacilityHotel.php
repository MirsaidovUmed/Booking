<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityHotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'facility_id',
        'hotel_id',
    ];

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }

    public function hotels()
    {
        return $this->belongsToMany(Hotel::class);
    }
}
