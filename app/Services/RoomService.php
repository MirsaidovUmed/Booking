<?php

namespace App\Services;

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

    public function create(Request $request)
    {
        $room = Room::create($request->all());

        return $room;
    }

    public function update(Request $request, int $id)
    {
        return Room::findOrFail($id)->update($request->all());
    }

    public function delete(int $id)
    {
        return Room::findOrFail($id)->delete();
    }
}
