<?php

namespace App\Dto;

class HotelDto{
    private ?string $title;
    private ?string $description;
    private ?string $posterUrl;
    private ?string $address;

    public function __construct(?string $title = null, ?string $description = null, ?string $posterUrl = null, ?string $address = null)
    {
        $this->title = $title;
        $this->description = $description;
        $this->posterUrl = $posterUrl;
        $this->address = $address;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getPosterUrl(): ?string
    {
        return $this->posterUrl;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }
}