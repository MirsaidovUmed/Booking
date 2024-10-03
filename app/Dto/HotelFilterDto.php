<?php

namespace App\Dto;

class HotelFilterDto{
    private ?int $priceMin;
    private ?int $priceMax;
    private ?string $category;
    private ?string $facilities;

    public function __construct(?int $priceMin, ?int $priceMax, ?string $category, ?string $facilities)
    {
        $this->priceMin = $priceMin;
        $this->priceMax = $priceMax;
        $this->category = $category;
        $this->facilities = $facilities;
    }

    public function getPriceMin(): ?int
    {
        return $this->priceMin;
    }

    public function getPriceMax(): ?int
    {
        return $this->priceMax;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function getFacilities(): ?string
    {
        return $this->facilities;
    }
}