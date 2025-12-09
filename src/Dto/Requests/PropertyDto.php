<?php

namespace App\Dto\Requests;

class PropertyDto
{
    private string $Title;
    private string $type;
    private int $views;
    private string $Description;
    private string $address;
    private int $price;
    private int $size;
    private int $location;
    private string $city;
    private int $bedrooms;
    private int $bathrooms;
    private int $ownerId;

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function setSize(int $size): void
    {
        $this->size = $size;
    }

    public function getBedrooms(): int
    {
        return $this->bedrooms;
    }

    public function setBedrooms(int $bedrooms): void
    {
        $this->bedrooms = $bedrooms;
    }

    public function getBathrooms(): int
    {
        return $this->bathrooms;
    }

    public function setBathrooms(int $bathrooms): void
    {
        $this->bathrooms = $bathrooms;
    }
}