<?php

namespace App\Services;

use App\Dto\HotelDto;
use App\Models\Hotel;
use App\Models\Room;

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

    public function create(HotelDto $hotelDto)
    {

        $hotel = New Hotel();

        $hotel->title = $hotelDto->title;
        $hotel->description = $hotelDto->description;
        $hotel->poster_url = $hotelDto->poster_url;
        $hotel->address = $hotelDto->address;

        $hotel->create();

        return $hotel;
    }

    public function update(HotelDto $hotelDto, int $id)
    {

        $hotel = Hotel::findOrFail($id);

        $hotel->title = $hotelDto->title;
        $hotel->description = $hotelDto->description;
        $hotel->poster_url = $hotelDto->poster_url;
        $hotel->address = $hotelDto->address;

        $hotel->update();

        return $hotel;
    }

    public function delete(int $id)
    {
        return Hotel::findOrFail($id)->delete();
    }
}
