<?php

namespace App\Dto;

use DateTime;

class BookingUpdateDto{
    private int $roomId;
    private int $userId;
    private DateTime $startedAt;
    private DateTime $finishedAt;
    private int $days;
    private int $price;

    public function __construct(int $roomId, int $userId, DateTime $startedAt, DateTime $finishedAt, int $days, int $price)
    {
        $this->roomId = $roomId;
        $this->userId = $userId;
        $this->startedAt = $startedAt;
        $this->finishedAt = $finishedAt;
        $this->days = $days;
        $this->price = $price;
    }

    public function getRoomId(): int
    {
        return $this->roomId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getStartedAt(): DateTime
    {
        return $this->startedAt;
    }

    public function getFinishedAt(): DateTime
    {
        return $this->finishedAt;
    }

    public function getDays(): int
    {
        return $this->days;
    }

    public function getPrice(): int
    {
        return $this->price;
    }
}