<?php

namespace App\Listeners;

use App\Events\BookingCreated;
use App\Mail\BookingCompletedMailing;
use App\Models\Booking;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendBookingConfirmation
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
    public function handle(BookingCreated $event): void
    {
        Mail::to($event->booking->user->email)->send(new BookingCompletedMailing($event->booking));
    }
}
