<?php

namespace App\Dto;

class HotelCreateDto{
    private string $title;
    private string $description;
    private string $posterUrl;
    private string $address;
    private float $price;

    public function __construct(string $title, string $description, string $posterUrl, string $address, float $price)
    {
        $this->title = $title;
        $this->description = $description;
        $this->posterUrl = $posterUrl;
        $this->address = $address;
        $this->price = $price;
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

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}