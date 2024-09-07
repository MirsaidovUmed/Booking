<?php

namespace App\Http\Controllers;

use App\Events\BookingCreated;
use App\Mail\BookingCompletedMailing;
use App\Models\Booking;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function validateBooking(Request $request)
    {
        $request->validate([
            "room_id" => "required|exists:rooms,id",
            "user_id" => "required|exists:users,id",
            "started_at"=>"required|date",
            "finished_at"=>"required|date|after_or_equal:started_at",
            "days"=> "required|integer|min:1",
            "price"=>"required|integer",
        ]);
    }

    public function index()
    {
        $bookings = Booking::paginate(10);
        return view('bookings.index', compact('bookings'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validateBooking($request);
        $booking = new Booking;
        $booking->create($request->all());
        event(new BookingCreated($booking));
        return back()->with('status', 'Booking successfully created');
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $this->validateBooking($request);
        $booking = Booking::findOrFail($id);
        $booking->update();
        return back()->with('status', 'Booking successfully updated');
    }

    public function destroy(int $id): RedirectResponse
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();
        return back()->with('status', 'Booking successfully deleted');    
    }
}
