<?php

namespace App\Dto;

class HotelFilterDto{
    private ?int $priceMin;
    private ?int $priceMax;
    private ?string $category;
    private ?array $facilities;

    public function __construct(?int $priceMin = null, ?int $priceMax = null, ?string $category = null, ?array $facilities = null)
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

    public function getFacilities(): ?array
    {
        return $this->facilities;
    }
}