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

        $booking->roomId = $bookingDto->getRoomId();
        $booking->userId = $bookingDto->getUserId();
        $booking->startedAt = $bookingDto->getStartedAt();
        $booking->finishedAt = $bookingDto->getFinishedAt();
        $booking->days = $bookingDto->getDays();
        $booking->price = $bookingDto->getPrice();

        $booking->save();
        
        Event(new BookingCreated($booking));

        return $booking;
    }

    public function update(BookingDto $bookingDto, int $id)
    {
        $booking = Booking::findOrFail($id);

        $booking->roomId = $bookingDto->getRoomId();
        $booking->userId = $bookingDto->getUserId();
        $booking->startedAt = $bookingDto->getStartedAt();
        $booking->finishedAt = $bookingDto->getFinishedAt();
        $booking->days = $bookingDto->getDays();
        $booking->price = $bookingDto->getPrice();

        $booking->update();
        
        return $booking;
    }

    public function delete(int $id)
    {
        return Booking::findOrFail($id)->delete();
    }
}
