<?php

namespace App\Services;

use App\Dto\BookingCreateDto;
use App\Dto\BookingUpdateDto;
use App\Events\BookingUpdated;
use App\Models\Booking;
use App\Events\BookingCreated;

class BookingService
{

    public function index()
    {
        return Booking::with('room')->paginate(10);
    }

    public function getBookingById(int $id)
    {
        return Booking::findOrFail($id);
    }

    public function create(BookingCreateDto $bookingDto)
    {
        $booking = new Booking();

        $booking->room_id = $bookingDto->getRoomId();
        $booking->user_id = $bookingDto->getUserId();
        $booking->started_at = $bookingDto->getStartedAt();
        $booking->finished_at = $bookingDto->getFinishedAt();
        $booking->days = $bookingDto->getDays();
        $booking->price = $bookingDto->getPrice();

        $booking->save();

        event(new BookingCreated($booking));

        return $booking;
    }

    public function update(BookingUpdateDto $bookingDto, int $id)
    {
        $booking = Booking::findOrFail($id);

        $booking->room_id = $bookingDto->getRoomId();
        $booking->user_id = $bookingDto->getUserId();
        $booking->started_at = $bookingDto->getStartedAt();
        $booking->finished_at = $bookingDto->getFinishedAt();
        $booking->days = $bookingDto->getDays();
        $booking->price = $bookingDto->getPrice();

        $booking->update();

        event(new BookingUpdated($booking));

        return $booking;
    }

    public function delete(int $id)
    {
        return Booking::findOrFail($id)->delete();
    }
}
