<?php

namespace App\Http\Controllers;

use App\Dto\HotelCreateDto;
use App\Dto\HotelFilterDto;
use App\Dto\HotelUpdateDto;
use App\Models\Facility;
use App\Services\HotelService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;

class HotelController extends Controller
{

    protected HotelService $hotelService;
    public ValidationFactory $validator;

    public function __construct(HotelService $hotelService, ValidationFactory $validator)
    {
        $this->validator = $validator;
        $this->hotelService = $hotelService;
    }

    public function index(Request $request): View
    {
        $this->validator->make($request->all(), [
            "price_min" => "nullable|numeric|min:0",
            "price_max" => "nullable|numeric|gte:price_min",
            "category" => "nullable|string",
            "facilities." => "integer|exists:facilities,id",
        ]);

        $hotelFilterDto = new HotelFilterDto(
            $request->input('price_min'),
            $request->input('price_max'),
            $request->input('category'),
            $request->input('facilities'),
        );

        $hotels = $this->hotelService->filterHotels($hotelFilterDto);
        $facilities = Facility::all();
        return view('hotels.index', ['hotels' => $hotels, 'facilities' => $facilities]);
    }

    public function getHotelById(int $id): View
    {
        $data = $this->hotelService->getHotelById($id);
        return view('hotels.show', $data);
    }

    public function store(Request $request): JsonResponse
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
            $request->input('price'),
        );
        $this->hotelService->create($hotelDto);
        return response()->json(['status' => 'Hotel Added successfully'], 201);
    }

    public function update(Request $request, int $id): JsonResponse
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
            $request->input('price'),
        );
        $this->hotelService->update($hotelDto, $id);
        return response()->json(['status' => 'Hotel Updated successfully'], 202);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->hotelService->delete($id);
        return response()->json(['status' => 'Hotel Deleted successfully'], 204);
    }
}
