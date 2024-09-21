<?php

namespace App\Dto;

class HotelCreateDto{
    private string $title;
    private string $description;
    private string $posterUrl;
    private string $address;

    public function __construct(string $title, string $description, string $posterUrl, string $address)
    {
        $this->title = $title;
        $this->description = $description;
        $this->posterUrl = $posterUrl;
        $this->address = $address;
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
}