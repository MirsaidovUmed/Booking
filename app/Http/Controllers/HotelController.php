<?php

namespace App\Http\Controllers;

use App\Dto\HotelCreateDto;
use App\Dto\HotelUpdateDto;
use App\Services\HotelService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;

class HotelController extends Controller
{

    protected HotelService $hotelService;
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
    
    public function store(Request $request)
    {
        $this->validator->make($request->all(), [
            "title" => "required|max:255",
            "description" => "required|max:255",
            "poster_url" => "required|url",
            "address" => "required",
        ]);

        $hotelDto = new HotelCreateDto(
            $request->input('title'),
            $request->input('description'),
            $request->input('poster_url'),
            $request->input('address'),
        );
        $this->hotelService->create($hotelDto);
        return response()->json(['status' => 'Hotel Added successfully'], 201);    
    }

    public function update(Request $request, int $id)
    {
        $this->validator->make($request->all(), [
            "title" => "required|max:255",
            "description" => "required|max:255",
            "poster_url" => "required|url",
            "address" => "required",
        ]);
        $hotelDto = new HotelUpdateDto(
            $request->input('title'),
            $request->input('description'),
            $request->input('poster_url'),
            $request->input('address'),
        );
        $this->hotelService->update($hotelDto, $id);
        return response()->json(['status' => 'Hotel Updated successfully'], 202);    
    }
    
    public function destroy(int $id)
    {
        $this->hotelService->delete($id);
        return response()->json(['status' => 'Hotel Deleted successfully'], 204);
    }
}
