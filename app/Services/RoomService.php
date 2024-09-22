<?php

namespace App\Services;

use App\Dto\RoomCreateDto;
use App\Dto\RoomUpdateDto;
use App\Models\Room;

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

    public function create(RoomCreateDto $roomDto)
    {
        $room = new Room();
        
        $room->title = $roomDto->getTitle();
        $room->description = $roomDto->getDescription();
        $room->poster_url = $roomDto->getPosterUrl();
        $room->floor_area = $roomDto->getFloorArea();
        $room->type = $roomDto->getType();
        $room->price = $roomDto->getPrice();
        $room->hotel_id = $roomDto->getHotelId();

        $room->save();

        return $room;
    }

    public function update(RoomUpdateDto $roomDto, int $id)
    {
        $room = Room::findOrFail($id); 

        $room->title = $roomDto->getTitle();
        $room->description = $roomDto->getDescription();
        $room->poster_url = $roomDto->getPosterUrl();
        $room->floor_area = $roomDto->getFloorArea();
        $room->type = $roomDto->gettType();
        $room->price = $roomDto->getPrice();
        $room->hotel_id = $roomDto->getHotelId();

        $room->update();

        return $room;
    }

    public function delete(int $id)
    {
        return Room::findOrFail($id)->delete();
    }
}
