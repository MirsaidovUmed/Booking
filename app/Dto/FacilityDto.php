<?php

namespace App\Dto;

class FacilityDto
{
    private string $title;
    private int $entityId;
    private string $entityType;

    public function __construct(string $title, int $entityId, string $entityType)
    {
        $this->title = $title;
        $this->entityId = $entityId;
        $this->entityType = $entityType;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getEntityId(): int
    {
        return $this->entityId;
    }

    public function getEntityType(): string
    {
        return $this->entityType;
    }
}
