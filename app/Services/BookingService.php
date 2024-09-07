<?php

namespace App\Services;

use App\Models\Booking;
use App\Events\BookingCreated;

class BookingService
{

    public function index()
    {
        return Booking::paginate(10);
    }

    public function create()
    {
        $booking = Booking::create();
        
        Event(new BookingCreated($booking));

        return $booking;
    }

    public function update(int $id)
    {
        return Booking::findOrFail($id)->update();
    }

    public function delete(int $id)
    {
        return Booking::findOrFail($id)->delete();
    }
}
