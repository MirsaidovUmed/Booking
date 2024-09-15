<?php

namespace App\Dto;

class RoomDto {
    private string $title;
    private string $description;
    private string $posterUrl;
    private string $floorArea;
    private string $type;
    private int $price;
    private int $hotelId;
    
    public function __construct(string $title, string $description, string $posterUrl, string $floorArea, string $type, int $price, int $hotelId)
    {
        $this->title = $title;
        $this->description = $description;
        $this->posterUrl = $posterUrl;
        $this->floorArea = $floorArea;
        $this->type = $type;
        $this->price = $price;
        $this->hotelId = $hotelId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPosterUrl(): string
    {
        return $this->posterUrl;
    }

    public function getFloorArea(): string
    {
        return $this->floorArea;
    }
    public function gettType(): string
    {
        return $this->description;
    }

    public function getPrice(): string
    {
        return $this->posterUrl;
    }

    public function getHotelId(): string
    {
        return $this->floorArea;
    }
}