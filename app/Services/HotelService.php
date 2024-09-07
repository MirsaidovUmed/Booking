<?php

namespace App\Services;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class HotelService
{

    public function index()
    {
        return Hotel::paginate(10);
    }

    public function getHotelById(int $id)
    {
        return Hotel::findOrFail($id);

    }

    public function create()
    {
        $booking = Hotel::create();

        return $booking;
    }

    public function update(int $id)
    {
        return Hotel::findOrFail($id)->update();
    }

    public function delete(int $id)
    {
        return Hotel::findOrFail($id)->delete();
    }
}
