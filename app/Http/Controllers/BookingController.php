<?php

namespace App\Http\Controllers;

use App\Services\BookingService;
use App\Services\BookingValidationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    protected $bookingService;
    protected $bookingValidationService;

    public function __construct(BookingService $bookingService, BookingValidationService $bookingValidationService)
    {
        $this->bookingService = $bookingService;
        $this->bookingValidationService = $bookingValidationService;
    }

    public function index()
    {
        $bookings = $this->bookingService->index();
        return view('bookings.index', compact('bookings'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->bookingValidationService->validate($request->all());
        $this->bookingService->create();
        return back()->with('status', 'Booking successfully created');
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $this->bookingValidationService->validate($request->all());
        $this->bookingService->update($id);
        return back()->with('status', 'Booking successfully updated');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->bookingService->delete($id);
        return back()->with('status', 'Booking successfully deleted');
    }
}
