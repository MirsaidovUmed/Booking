<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Services\HotelService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HotelController extends Controller
{

    public $hotelService;

    public function __construct(HotelService $hotelService)
    {
        $this->hotelService = $hotelService;
    }

    public function index(): View
    {
        $hotels = $this->hotelService->index();
        return view('hotels.index', compact('hotels'));
    }

    public function getHotelById(int $id): View
    {
        $hotel = $this->hotelService->getHotelById($id);
        return view('hotels.show', compact('hotel'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $this->hotelService->create($request);
        return back()->with('status', 'Hotel Added successfully');
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $this->hotelService->update($request, $id);
        return back()->with('status', 'Hotel updated successfully');
    }
    
    public function destroy(int $id): RedirectResponse
    {
        $this->hotelService->delete($id);
        return back()->with('status', 'Hotel deleted successfully');
    }
}
