<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityHotel extends Model
{
    use HasFactory;

    protected $filable = [
        'facility_id',
        'hotel_id',
    ];

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
