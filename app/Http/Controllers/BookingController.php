<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::paginate(10);
        return view('bookings.index', compact('bookings'));
    }

    public function store(Request $request): RedirectResponse
    {
        $booking = new Booking;
        $request->validate([
            "room_id" => "required|exists:rooms,id",
            "user_id" => "required|exists:users,id",
            "started_at"=>"required|date",
            "finished_at"=>"required|date",
            "days"=> "required|date",
            "price"=>"required|integer",
        ]);
        $booking->create($request->all());
        return back()->with('status', 'Booking successfully created');
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $booking = Booking::findOrFail($id);
        $request->validate([
            "room_id" => "required|exists:rooms,id",
            "user_id" => "required|exists:users,id",
            "started_at"=>"required|date",
            "finished_at"=>"required|date",
            "days"=> "required|date",
            "price"=>"required|integer",
        ]);

        $booking->room_id = $request->input('room_id') ?? $booking->room_id;
        $booking->user_id = $request->input('user_id') ?? $booking->user_id;
        $booking->started_at = $request->input('started_at') ?? $booking->started_at;
        $booking->finished_at = $request->input('finished_at') ?? $booking->finished_at;
        $booking->days = $request->input('days') ?? $booking->days;
        $booking->price = $request->input('price') ?? $booking->price;

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
