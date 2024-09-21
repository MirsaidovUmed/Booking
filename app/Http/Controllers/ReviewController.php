<?php

namespace App\Http\Controllers;

use App\Dto\ReviewDto;
use App\Services\ReviewService;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;


class ReviewController extends Controller
{
    public $reviewService;
    public $validator;

    public function __construct(ValidationFactory $validator, ReviewService $reviewService)
    {
        $this->validator = $validator;
        $this->reviewService = $reviewService;
    }

    public function store(Request $request)
    {
        $this->validator->make($request->all(), [
            "user_id" => "required|exists:users,id",
            "hotel_id" => "required|exists:hotels,id",
            "review" => "required|max:255",
            "raiting" => "required|integer",
        ]);

        $reviewDto = new ReviewDto(
            $request->input('user_id'),
            $request->input('user_id'),
            $request->input('review'),
            $request->input('raiting'),
        );

        $this->reviewService->createReview($reviewDto);
        return back()->with('status', 'Review Added successfully');
    }

    public function destroy(int $id)
    {
        $this->reviewService->delete($id);
        return back()->with('status', 'Review Deleted successfully');
    }
}
