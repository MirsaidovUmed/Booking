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
        
        $room->title = $roomDto->title;
        $room->descrption = $roomDto->description;
        $room->posterUrl = $roomDto->posterUrl;
        $room->floorArea = $roomDto->floorArea;
        $room->type = $roomDto->type;
        $room->price = $roomDto->price;
        $room->hotelId = $roomDto->hotelId;

        $room->save();

        return $room;
    }

    public function update(RoomDto $roomDto, int $id)
    {
        $room = Room::findOrFail($id); 

        $room->title = $roomDto->title;
        $room->descrption = $roomDto->description;
        $room->posterUrl = $roomDto->posterUrl;
        $room->floorArea = $roomDto->floorArea;
        $room->type = $roomDto->type;
        $room->price = $roomDto->price;
        $room->hotelId = $roomDto->hotelId;

        $room->update();

        return $room;
    }

    public function delete(int $id)
    {
        return Room::findOrFail($id)->delete();
    }
}
