<?php

namespace App\Services;

use App\Dto\RoomDto;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomService
{

    public function index()
    {
        return Room::paginate(10);
    }

    public function getRoomById(int $id)
    {
        return Room::findOrFail($id);
    }

    public function create(RoomDto $roomDto)
    {
        $room = new Room();
        
        $room->title = $roomDto->getTitle();
        $room->descrption = $roomDto->getDescription();
        $room->posterUrl = $roomDto->getPosterUrl();
        $room->floorArea = $roomDto->getFloorArea();
        $room->type = $roomDto->gettType();
        $room->price = $roomDto->getPrice();
        $room->hotelId = $roomDto->getHotelId();

        $room->save();

        return $room;
    }

    public function update(RoomDto $roomDto, int $id)
    {
        $room = Room::findOrFail($id); 

        $room->title = $roomDto->getTitle();
        $room->descrption = $roomDto->getDescription();
        $room->posterUrl = $roomDto->getPosterUrl();
        $room->floorArea = $roomDto->getFloorArea();
        $room->type = $roomDto->gettType();
        $room->price = $roomDto->getPrice();
        $room->hotelId = $roomDto->getHotelId();

        $room->update();

        return $room;
    }

    public function delete(int $id)
    {
        return Room::findOrFail($id)->delete();
    }
}
