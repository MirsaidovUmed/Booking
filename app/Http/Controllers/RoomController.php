<?php

namespace App\Http\Controllers;

use App\Dto\RoomCreateDto;
use App\Dto\RoomUpdateDto;
use App\Services\RoomService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;


class RoomController extends Controller
{
    public $roomService;
    public $validator;

    public function __construct(RoomService $roomService, ValidationFactory $validator)
    {
        $this->validator = $validator;
        $this->roomService = $roomService;
    }

    public function index(): View
    {
        $rooms = $this->roomService->index();
        return view('components.rooms.room-list-item', ['rooms' => $rooms]);
    }

    public function getRoomById(int $id)
    {
        $room = $this->roomService->getRoomById($id);
        return view('components.rooms.room-list-item', ['room' => $room]);
    }

    public function store(Request $request)
    {
        $this->validator->make($request->all(), [
            "title" => "required|max:255",
            "description" => "required|max:255",
            "poster_url" => "required|url",
            "floor_area" => "required",
            "price" => "required|integer",
            "type" => "required",
            "hotel_id" => "required|exists:hotels,id",
        ]);

        $roomDto = new RoomCreateDto(
            $request->input('title'),
            $request->input('description'),
            $request->input('poster_url'),
            $request->input('floor_area'),
            $request->input('type'),
            $request->input('price'),
            $request->input('hotel_id'),
        );

        $this->roomService->create($roomDto);
        return response()->json(['status' => 'Room Added successfully'], 201);    
    }

    public function update(Request $request, int $id)
    {
        $roomDto = new RoomUpdateDto(
            $request->input('title'),
            $request->input('description'),
            $request->input('poster_url'),
            $request->input('floor_area'),
            $request->input('type'),
            $request->input('price'),
            $request->input('hotel_id'),
        );

        $this->roomService->update($roomDto, $id);
        return response()->json(['status' => 'Room Updated successfully'], 202);    
    }

    public function destroy(int $id)
    {
        $this->roomService->delete($id);
        return response()->json(['status' => 'Room Deleted successfully'], 204);    
    }
}
