<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class HotelValidationService
{
    public function validate(array $data)
    {
        $validator = Validator::make($data, [
            "title" => "required|max:255",
            "description" => "required|max:255",
            "poster_url" => "required|url",
            "address" => "required",
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}