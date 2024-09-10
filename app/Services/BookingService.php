<?php

namespace App\Services;

use App\Models\Booking;
use App\Events\BookingCreated;
use Illuminate\Http\Request;

class BookingService
{

    public function index()
    {
        return Booking::paginate(10);
    }

    public function create(Request $request)
    {
        $booking = Booking::create($request->all());
        
        Event(new BookingCreated($booking));

        return $booking;
    }

    public function update(Request $request, int $id)
    {
        return Booking::findOrFail($id)->update($request->all());
    }

    public function delete(int $id)
    {
        return Booking::findOrFail($id)->delete();
    }
}
