<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BookingValidationService
{
    public function validate(array $data)
    {
        $validator = Validator::make($data, [
            "room_id" => "required|exists:rooms,id",
            "user_id" => "required|exists:users,id",
            "started_at" => "required|date",
            "finished_at" => "required|date|after_or_equal:started_at",
            "days" => "required|integer|min:1",
            "price" => "required|integer",
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
