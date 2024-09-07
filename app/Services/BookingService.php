<?php

namespace App\Services;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use App\Events\BookingCreated;

class BookingService
{
    public function validateBooking(Request $request)
    {
        $request->validate([
            "room_id" => "required|exists:rooms,id",
            "user_id" => "required|exists:users,id",
            "started_at" => "required|date",
            "finished_at" => "required|date|after_or_equal:started_at",
            "days" => "required|integer|min:1",
            "price" => "required|integer",
        ]);
    }

    public function index()
    {
        return Booking::paginate(10);
    }

    public function create(Request $request)
    {
        $this->validateBooking($request);
        $booking = Booking::create();
        
        Event::dispatch(new BookingCreated($booking));

        return $booking;
    }

    public function update(Request $request, int $id)
    {
        $this->validateBooking($request);
        return Booking::findOrFail($id)->update();
    }

    public function delete(int $id)
    {
        return Booking::findOrFail($id)->delete();
    }
}
