<?php

namespace App\Http\Controllers;

use App\Dto\BookingCreateDto;
use App\Dto\BookingUpdateDto;
use App\Services\BookingService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class BookingController extends Controller
{
    protected BookingService $bookingService;
    protected ValidationFactory $validator;

    public function __construct(BookingService $bookingService, ValidationFactory $validator)
    {
        $this->bookingService = $bookingService;
        $this->validator = $validator;
    }

    public function index(): View
    {
        $bookings = $this->bookingService->index();
        return view('bookings.index', ['bookings' => $bookings]);
    }

    public function getBookingById(int $id): View
    {
        $booking = $this->bookingService->getBookingById($id);
        return view('bookings.show', ['booking' => $booking]);
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
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

    /**
     * @throws ValidationException
     */
    public function update(Request $request, int $id): JsonResponse
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

    public function destroy(int $id): Response
    {
        $this->bookingService->delete($id);
        return response()->noContent();
    }
}
