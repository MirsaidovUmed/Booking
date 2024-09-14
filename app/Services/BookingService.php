<?php

namespace App\Services;

use App\Dto\BookingDto;
use App\Models\Booking;
use App\Events\BookingCreated;

class BookingService
{

    public function index()
    {
        return Booking::paginate(10);
    }

    public function create(BookingDto $bookingDto)
    {
        $booking = new Booking();

        $booking->roomId = $bookingDto->roomId;
        $booking->userId = $bookingDto->userId;
        $booking->startedAt = $bookingDto->startedAt;
        $booking->finishedAt = $bookingDto->finishedAt;
        $booking->days = $bookingDto->days;
        $booking->price = $bookingDto->price;

        $booking->save();
        
        Event(new BookingCreated($booking));

        return $booking;
    }

    public function update(BookingDto $bookingDto, int $id)
    {
        $booking = Booking::findOrFail($id);

        $booking->roomId = $bookingDto->roomId;
        $booking->userId = $bookingDto->userId;
        $booking->startedAt = $bookingDto->startedAt;
        $booking->finishedAt = $bookingDto->finishedAt;
        $booking->days = $bookingDto->days;
        $booking->price = $bookingDto->price;

        $booking->update();
        
        return $booking;
    }

    public function delete(int $id)
    {
        return Booking::findOrFail($id)->delete();
    }
}
