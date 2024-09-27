<?php

namespace App\Listeners;

use App\Events\BookingUpdated;
use App\Mail\BookingUpdateMailing;
use App\Models\Booking;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendBookingChanging
{
    /**
     * Create the event listener.
     */

    public $booking;
    public $user;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
        $this->user = $booking->user;
    }

    /**
     * Handle the event.
     */
    public function handle(BookingUpdated $event): void
    {
        Mail::to($event->booking->user->email)->send(new BookingUpdateMailing($event->booking));
    }
}
