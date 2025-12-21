<?php

namespace App\Dto\Responses;

class PropertyAllResponse 
{
    private int $id;
    private ?string $Title;
    private ?string $type;
    private ?int $views;
    private ?string $Description;
    private ?int $price;
    private ?int $size;
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


    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function getLocation(): ?string
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

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setTitle(?string $Title): void
    {
        $this->Title = $Title;
    }

    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    public function setViews(?int $views): void
    {
        $this->views = $views;
    }

    public function setDescription(?string $Description): void
    {
        $this->Description = $Description;
    }

    public function setPrice(?int $price): void
    {
        $this->price = $price;
    }

    public function setSize(?int $size): void
    {
        $this->size = $size;
    }

    public function setLocation(?string $location): void
    {
        $this->location = $location;
    }

    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    public function setBedrooms(?int $bedrooms): void
    {
        $this->bedrooms = $bedrooms;
    }

    public function setBathrooms(?int $bathrooms): void
    {
        $this->bathrooms = $bathrooms;
    }

    public function setOwnerId(?int $ownerId): void
    {
        $this->ownerId = $ownerId;
    }

    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }
    public function getStatus(): ?string
    {
        return $this->status;
    }
    public function setSurface(?string $surface): void
    {
        $this->surface = $surface;
    }
    public function getSurface(): ?string
    {
        return $this->surface;
    }
    public function setCharacteristic(?array $characteristic): void
    {
        $this->characteristic = $characteristic;
    }
    public function getCharacteristic(): ?array
    {
        return $this->characteristic;
    }
    public function setMedia(?array $media): void
    {
        $this->media = $media;
    }
    public function getMedia(): ?array
    {
        return $this->media;
    }

    public function getTypeTransaction(): string
    {
        return $this->typeTransaction;
    }
    public function setTypeTransaction(string $typeTransaction): void
    {
        $this->typeTransaction = $typeTransaction;
    }
    
}