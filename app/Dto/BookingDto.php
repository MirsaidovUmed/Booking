<?php

namespace App\Dto;

use DateTime;

class BookingDto{
    public int $roomId;
    public int $userId;
    public DateTime $startedAt;
    public DateTime $finishedAt;
    public int $days;
    public int $price;

    public function __construct(int $roomId, int $userId, DateTime $startedAt, DateTime $finishedAt, int $days, int $price)
    {
        $this->roomId = $roomId;
        $this->userId = $userId;
        $this->startedAt = $startedAt;
        $this->finishedAt = $finishedAt;
        $this->days = $days;
        $this->price = $price;
    }
}
