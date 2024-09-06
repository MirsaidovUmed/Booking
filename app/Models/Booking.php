<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $filable = [
        'room_id',
        'user_id',
        'started_at',
        'finished_at',
        'days',
        'price',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class);
    }
}
