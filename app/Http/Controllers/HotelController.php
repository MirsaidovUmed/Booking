<?php

namespace App\Http\Controllers;

use App\Dto\HotelDto;
use App\Models\Hotel;
use App\Services\HotelService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Validation\ValidationException;

class HotelController extends Controller
{

    public $hotelService;
    public $validator;
    
    public function __construct(HotelService $hotelService, ValidationFactory $validator)
    {
        $this->validator = $validator;
        $this->hotelService = $hotelService;
    }

    public function index(): View
    {
        $hotels = $this->hotelService->index();
        return view('hotels.index', ['hotels' => $hotels]);
    }

    public function getHotelById(int $id): View
    {
        $data = $this->hotelService->getHotelById($id);
        return view('hotels.show', $data);
    }
    
    public function store(Request $request): RedirectResponse
    {
        $this->validator->make($request->all(), [
            "title" => "required|max:255",
            "description" => "required|max:255",
            "poster_url" => "required|url",
            "address" => "required",
        ]);

        $hotelDto = new HotelDto(
            $request->input('title'),
            $request->input('description'),
            $request->input('poster_url'),
            $request->input('address'),
        );
        $this->hotelService->create($hotelDto);
        return back()->with('status', 'Hotel Added successfully');    
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $this->validator->make($request->all(), [
            "title" => "required|max:255",
            "description" => "required|max:255",
            "poster_url" => "required|url",
            "address" => "required",
        ]);
        $hotelDto = new HotelDto(
            $request->input('title'),
            $request->input('description'),
            $request->input('poster_url'),
            $request->input('address'),
        );
        $this->hotelService->update($hotelDto, $id);
        return back()->with('status', 'Hotel updated successfully');
    }
    
    public function destroy(int $id): RedirectResponse
    {
        $this->hotelService->delete($id);
        return back()->with('status', 'Hotel deleted successfully');
    }
}
