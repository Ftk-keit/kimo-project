<?php

namespace App\Dto\Responses;

class PropertyAllResponse 
{
    private int $id;
    private ?string $Title;
    private ?string $type;
    private ?int $views;
    private ?string $Description;
    private ?string $address;
    private ?int $price;
    private ?int $size;
    private ?int $location;
    private ?string $city;
    private ?int $bedrooms;
    private ?int $bathrooms;
    private ?int $ownerId;

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getViews(): ?int
    {
        return $this->views;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function getLocation(): ?int
    {
        return $this->location;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function getBedrooms(): ?int
    {
        return $this->bedrooms;
    }

    public function getBathrooms(): ?int
    {
        return $this->bathrooms;
    }

    public function getOwnerId(): ?int
    {
        return $this->ownerId;
    }
}