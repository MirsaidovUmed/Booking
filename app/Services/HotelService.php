<?php

namespace App\Services;

use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Http\Request;

class HotelService
{

    public function index()
    {
        return Hotel::paginate(10);
    }

    public function getHotelById(int $id)
    {
        $rooms = Room::all();
        $hotel = Hotel::findOrFail($id);
        return compact('hotel','rooms');
    }

    public function create(Request $request)
    {
        $booking = Hotel::create($request->all());

        return $booking;
    }

    public function update(Request $request, int $id)
    {
        return Hotel::findOrFail($id)->update($request->all());
    }

    public function delete(int $id)
    {
        return Hotel::findOrFail($id)->delete();
    }
}
