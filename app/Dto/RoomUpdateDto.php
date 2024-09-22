<?php

namespace App\Dto;

class RoomUpdateDto {
    private string $title;
    private string $description;
    private string $posterUrl;
    private float $floorArea;
    private string $type;
    private int $price;
    private int $hotelId;
    
    public function __construct(string $title, string $description, string $posterUrl, float $floorArea, string $type, int $price, int $hotelId)
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

    public function getFloorArea(): float
    {
        return $this->floorArea;
    }
    public function gettType(): string
    {
        return $this->type;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getHotelId(): int
    {
        return $this->hotelId;
    }
}