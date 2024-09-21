<?php

namespace App\Http\Controllers;

use App\Dto\RoomDto;
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
        return view('rooms.room-list-item', ['rooms', $rooms]);
    }

    public function getRoomById(int $id)
    {
        $room = $this->roomService->getRoomById($id);
        return view('rooms.room-list-item', ['room', $room]);
    }

    public function store(Request $request): RedirectResponse
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

        $roomDto = new RoomDto(
            $request->input('title'),
            $request->input('description'),
            $request->input('poster_url'),
            $request->input('floor_area'),
            $request->input('price'),
            $request->input('type'),
            $request->input('hotel_id'),
        );

        $this->roomService->create($roomDto);
        return back()->with('status', 'Room Added successfully');
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $roomDto = new RoomDto(
            $request->input('title'),
            $request->input('description'),
            $request->input('poster_url'),
            $request->input('floor_area'),
            $request->input('price'),
            $request->input('type'),
            $request->input('hotel_id'),
        );

        $this->roomService->update($roomDto, $id);
        return back()->with('status', 'Room updated successfully');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->roomService->delete($id);
        return back()->with('status', 'Room deleted successfully');
    }
}
