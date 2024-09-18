<?php

namespace App\Services;

use App\Dto\ReviewDto;
use App\Models\Review;

class ReviewService{
    public function createReview(ReviewDto $reviewDto)
    {
        $review = new Review();
        
        $review->userId = $reviewDto->getUserId();
        $review->hotelId = $reviewDto->getHotelId();
        $review->review = $reviewDto->getReview();
        $review->raiting = $reviewDto->getRaiting();

        $review->create();
        
        return $review;
    }

    public function delete(int $id)
    {
        return Review::findOrFail($id);
    }
}