<?php

namespace App\Dto\Requests;

use Symfony\Component\Validator\Constraints as Assert;

class MediaDto
{
    #[Assert\NotBlank(message: 'Url is required')]
    #[Assert\NotNull(message:'Url is required')]
    private ?string $url;

    #[Assert\NotBlank(message: 'PropertyId is required')]
    #[Assert\NotNull(message:'PropertyId is required')]
    private ?int $propertyId;

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getPropertyId(): ?int
    {
        return $this->propertyId;
    }

    public function setPropertyId(?int $propertyId): static
    {
        $this->propertyId = $propertyId;

        return $this;
    }
}
