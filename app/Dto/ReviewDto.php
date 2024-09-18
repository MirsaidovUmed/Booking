<?php

namespace App\Dto;

class ReviewDto
{
    private int $userId;
    private int $hotelId;
    private string $review;
    private int $rating;

    public function __construct(int $userId, int $hotelId, string $review, int $rating)
    {
        $this->userId = $userId;
        $this->hotelId = $hotelId;
        $this->review = $review;
        $this->rating = $rating;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
    public function getHotelId(): int
    {
        return $this->hotelId;
    }
    public function getReview(): string
    {
        return $this->review;
    }
    public function getRaiting(): int
    {
        return $this->rating;
    }
}
