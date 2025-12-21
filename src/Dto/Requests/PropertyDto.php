<?php

namespace App\Dto\Requests;

class PropertyDto
{
   private ?string $title;
    private ?string $type;
    private ?int $views;
    private ?string $description;
    private ?int $price;
    private ?string $location;
    private ?string $city;
    private ?int $bedrooms;
    private ?int $bathrooms;
    private ?int $ownerId;
    private ?string $status;
    private ?string $surface;
    private ?array $characteristic;
    private ?array $media;
    private ?string $typeTransaction;

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): void
    {
        $this->price = $price;
    }
    public function getBedrooms(): ?int
    {
        return $this->bedrooms;
    }

    public function setBedrooms(?int $bedrooms): void
    {
        $this->bedrooms = $bedrooms;
    }

    public function getBathrooms(): ?int
    {
        return $this->bathrooms;
    }

    public function setBathrooms(?int $bathrooms): void
    {
        $this->bathrooms = $bathrooms;
    }
    public function getLocation(): ?string
    {
        return $this->location;
    }
    public function setLocation(?string $location): void
    {
        $this->location = $location;
    }
    public function getTitle(): ?string
    {
        return $this->title;
    }
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }
    public function getViews(): ?int
    {
        return $this->views;
    }
    public function setViews(?int $views): void
    {
        $this->views = $views;
    }
    public function getCity(): ?string
    {
        return $this->city;
    }
    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    public function getOwnerId(): ?int
    {
        return $this->ownerId;
    }

    public function setOwnerId(?int $ownerId): void
    {
        $this->ownerId = $ownerId;
    }
    public function getStatus(): ?string
    {
        return $this->status;
    }
    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }
    public function getSurface(): ?string
    {
        return $this->surface;
    }
    public function setSurface(?string $surface): void
    {
        $this->surface = $surface;
    }
    public function getCharacteristic(): ?array
    {
        return $this->characteristic;
    }
    public function setCharacteristic(?array $characteristic): void
    {
        $this->characteristic = $characteristic;
    }
    public function setMedia(?array $media): void
    {
        $this->media = $media;
    }
    public function getMedia(): ?array
    {
        return $this->media;
    }
    public function getTypeTransaction(): ?string
    {
        return $this->typeTransaction;
    }
    public function setTypeTransaction(?string $typeTransaction): void
    {
        $this->typeTransaction = $typeTransaction;
    }
}