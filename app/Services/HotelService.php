<?php

namespace App\Services;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class HotelService
{
    protected function validateHotel(Request $request)
    {
        return $request->validate([
            "title" => "required|max:255",
            "description" => "required|max:255",
            "poster_url" => "required|url",
            "address" => "required",
        ]);
    }

    public function index()
    {
        return Hotel::paginate(10);
    }

    public function getHotelById(int $id)
    {
        return Hotel::findOrFail($id);

    }

    public function create(Request $request)
    {
        $this->validateHotel($request);
        $booking = Hotel::create();

        return $booking;
    }

    public function update(Request $request, int $id)
    {
        $this->validateHotel($request);
        return Hotel::findOrFail($id)->update();
    }

    public function delete(int $id)
    {
        return Hotel::findOrFail($id)->delete();
    }
}
