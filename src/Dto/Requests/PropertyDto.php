<?php

namespace App\Dto\Requests;

use Symfony\Component\Validator\Constraints as Assert;

class PropertyDto
{
    #[Assert\NotBlank(message: 'Title is required')]
    #[Assert\NotNull(message:'Title is required')]
    private ?string $title;

    #[Assert\NotBlank(message: 'Type is required')]
    #[Assert\NotNull(message:'Type is required')]
    private ?string $type;

    #[Assert\NotBlank(message: 'Views is required')]
    #[Assert\NotNull(message:'Views is required')]
    private ?int $views;

    #[Assert\NotBlank(message: 'Description is required')]
    #[Assert\NotNull(message:'Description is required')]
    private ?string $description;

    #[Assert\NotBlank(message: 'Price is required')]
    #[Assert\NotNull(message:'Price is required')]
    private ?int $price;

    #[Assert\NotBlank(message: 'Location is required')]
    #[Assert\NotNull(message:'Location is required')]
    private ?string $location;

    #[Assert\NotBlank(message: 'City is required')]
    #[Assert\NotNull(message:'City is required')]
    private ?string $city;

    #[Assert\NotBlank(message: 'Bedrooms is required')]
    #[Assert\NotNull(message:'Bedrooms is required')]
    private ?int $bedrooms;

    #[Assert\NotBlank(message: 'Bathrooms is required')]
    #[Assert\NotNull(message:'Bathrooms is required')]
    private ?int $bathrooms;

    #[Assert\NotBlank(message: 'OwnerId is required')]
    #[Assert\NotNull(message:'OwnerId is required')]
    private ?int $ownerId;

    #[Assert\NotBlank(message: 'Status is required')]
    #[Assert\NotNull(message:'Status is required')]
    private ?string $status;

    #[Assert\NotBlank(message: 'Surface is required')]
    #[Assert\NotNull(message:'Surface is required')]
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