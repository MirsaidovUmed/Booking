<?php

namespace App\Http\Controllers;

use App\Services\BookingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Validation\ValidationException;

class BookingController extends Controller
{
    protected $bookingService;
    protected $validator;

    public function __construct(BookingService $bookingService, ValidationFactory $validator)
    {
        $this->bookingService = $bookingService;
        $this->validator = $validator;
    }

    public function index()
    {
        $bookings = $this->bookingService->index();
        return view('bookings.index', compact('bookings'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validator->make($request->all(), [
            "room_id" => "required|exists:rooms,id",
            "user_id" => "required|exists:users,id",
            "started_at" => "required|date",
            "finished_at" => "required|date|after_or_equal:started_at",
            "days" => "required|integer|min:1",
            "price" => "required|integer",
        ])->validate();
        $this->bookingService->create($request);
        return back()->with('status', 'Booking successfully created');
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $this->validator->make($request->all(), [
            "room_id" => "required|exists:rooms,id",
            "user_id" => "required|exists:users,id",
            "started_at" => "required|date",
            "finished_at" => "required|date|after_or_equal:started_at",
            "days" => "required|integer|min:1",
            "price" => "required|integer",
        ])->validate();
        $this->bookingService->update($request, $id);
        return back()->with('status', 'Booking successfully updated');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->bookingService->delete($id);
        return back()->with('status', 'Booking successfully deleted');
    }
}
