<?php

namespace App\Dto;

class HotelDto{
    public string $title;
    public string $description;
    public string $poster_url;
    public string $address;

    public function __construct(string $title, string $description, string $poster_url, string $address)
    {
        $this->title = $title;
        $this->description = $description;
        $this->poster_url = $poster_url;
        $this->address = $address;
    }
}