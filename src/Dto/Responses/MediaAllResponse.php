<?php

namespace App\Dto\Responses;

class MediaAllResponse
{
    private int $id;
    private string $url;
    private int $propertyId;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getPropertyId(): int
    {
        return $this->propertyId;
    }

    public function setPropertyId(int $propertyId): static
    {
        $this->propertyId = $propertyId;

        return $this;
    }
}
