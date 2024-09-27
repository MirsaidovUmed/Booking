<?php

namespace App\Http\Controllers;

use App\Dto\BookingCreateDto;
use App\Dto\BookingUpdateDto;
use App\Services\BookingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Support\Facades\Log;

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
        return view('bookings.index', ['bookings' => $bookings]);
    }

    public function getBookingById(int $id)
    {
        $booking = $this->bookingService->getBookingById($id);
        return view('bookings.show', ['booking' => $booking]);
    }

    public function store(Request $request)
    {
        $this->validator->make($request->all(), [
            "room_id" => "required|exists:rooms,id",
            "user_id" => "required|exists:users,id",
            "started_at" => "required|date",
            "finished_at" => "required|date|after_or_equal:started_at",
            "days" => "required|integer|min:1",
            "price" => "required|integer",
        ])->validate();

        $bookingDto = new BookingCreateDto(
            $request->input('room_id'),
            $request->input('user_id'),
            $request->input('started_at'),
            $request->input('finished_at'),
            $request->input('days'),
            $request->input('price'),
        );
        $this->bookingService->create($bookingDto);
        return response()->json(['status' => 'Booking Added successfully'], 201); 
    }

    public function update(Request $request, int $id)
    {
        $this->validator->make($request->all(), [
            "room_id" => "required|exists:rooms,id",
            "user_id" => "required|exists:users,id",
            "started_at" => "required|date",
            "finished_at" => "required|date|after_or_equal:started_at",
            "days" => "required|integer|min:1",
            "price" => "required|integer",
        ])->validate();
        $bookingDto = new BookingUpdateDto(
            $request->input('room_id'),
            $request->input('user_id'),
            $request->input('started_at'),
            $request->input('finished_at'),
            $request->input('days'),
            $request->input('price'),
        );
        $this->bookingService->update($bookingDto, $id);
        return response()->json(['status' => 'Booking Updated successfully'], 202);    
    }

    public function destroy(int $id)
    {
        $this->bookingService->delete($id);
        return response()->noContent();
    }
}
