<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Services\BookingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function index()
    {
        $bookings = $this->bookingService->index();
        return view('bookings.index', compact('bookings'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->bookingService->create($request);
        return back()->with('status', 'Booking successfully created');
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $this->bookingService->update($request, $id);
        return back()->with('status', 'Booking successfully updated');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->bookingService->delete($id);
        return back()->with('status', 'Booking successfully deleted');
    }
}
