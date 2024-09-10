<?php

namespace App\Http\Controllers;

use App\Services\RoomService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public $roomService;

    public function __construct(RoomService $roomService)
    {
        $this->roomService = $roomService;
    }

    public function index(): View
    {
        $rooms = $this->roomService->index();
        return view('rooms.room-list-item', compact('rooms'));
    }

    public function getRoomById(int $id)
    {
        $room = $this->roomService->getRoomById($id);
        return view('rooms.room-list-item', compact('room'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->roomService->create($request);
        return back()->with('status', 'Room Added successfully');
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $this->roomService->update($request, $id);
        return back()->with('status', 'Room updated successfully');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->roomService->delete($id);
        return back()->with('status', 'Room deleted successfully');
    }
}
