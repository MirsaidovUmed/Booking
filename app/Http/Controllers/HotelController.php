<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Services\HotelService;
use App\Services\HotelValidationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HotelController extends Controller
{

    public $hotelService;
    public $hotelValidationService;
    
    public function __construct(HotelService $hotelService, HotelValidationService $hotelValidationService)
    {
        $this->hotelValidationService = $hotelValidationService;
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
        $this->hotelValidationService->validate($request->all());
        $this->hotelService->create();
        return back()->with('status', 'Hotel Added successfully');
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $this->hotelValidationService->validate($request->all());
        $this->hotelService->update($id);
        return back()->with('status', 'Hotel updated successfully');
    }
    
    public function destroy(int $id): RedirectResponse
    {
        $this->hotelService->delete($id);
        return back()->with('status', 'Hotel deleted successfully');
    }
}
