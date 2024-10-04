<?php

namespace App\Services;

use App\Dto\HotelCreateDto;
use App\Dto\HotelFilterDto;
use App\Dto\HotelUpdateDto;
use App\Models\FacilityEntity;
use App\Models\Hotel;
use App\Models\Room;

class HotelService
{

    public function index()
    {
        return Hotel::paginate(10);
    }

    public function filterHotels(HotelFilterDto $hotelFilterDto)
    {
        $hotels = Hotel::query();

        if ($hotelFilterDto->getPriceMin() != null && $hotelFilterDto->getPriceMax() != null)
        {
            $hotels->whereBetween('price', [$hotelFilterDto->getPriceMin(), $hotelFilterDto->getPriceMax()]);
        }

        if ($hotelFilterDto->getCategory())
        {
            $hotels->where('category', $hotelFilterDto->getCategory());
        }

        if ($hotelFilterDto->getFacilities())
        {
            $facilityIds = $hotelFilterDto->getFacilities();
            $hotels->whereHas('facilities', function ($query) use ($facilityIds) {
                    $query->whereIn('facility_id', $facilityIds);
            });
        }

        return $hotels->paginate(10);
    }

    public function getHotelById(int $id)
    {
        $rooms = Room::all();
        $hotel = Hotel::findOrFail($id);
        return compact('hotel','rooms');
    }

    public function create(HotelCreateDto $hotelDto)
    {
        $hotel = New Hotel();

        $hotel->title = $hotelDto->getTitle();
        $hotel->description = $hotelDto->getDescription();
        $hotel->poster_url = $hotelDto->getPosterUrl();
        $hotel->address = $hotelDto->getAddress();
        $hotel->price = $hotelDto->getPrice();
        $hotel->save();

        return $hotel;
    }

    public function update(HotelUpdateDto $hotelDto, int $id)
    {
        $hotel = Hotel::findOrFail($id);

        $hotel->title = $hotelDto->getTitle();
        $hotel->description = $hotelDto->getDescription();
        $hotel->poster_url = $hotelDto->getPosterUrl();
        $hotel->address = $hotelDto->getAddress();
        $hotel->price = $hotelDto->getPrice();
        $hotel->update();

        return $hotel;
    }

    public function delete(int $id)
    {
        return Hotel::findOrFail($id)->delete();
    }
}
