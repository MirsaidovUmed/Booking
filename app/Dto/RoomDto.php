<?php

namespace App\Dto;

class RoomDto {
    public string $title;
    public string $description;
    public string $posterUrl;
    public string $floorArea;
    public string $type;
    public int $price;
    public int $hotelId;
    
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
}