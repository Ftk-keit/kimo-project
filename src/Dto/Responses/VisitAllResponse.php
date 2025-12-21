<?php

namespace App\Dto\Responses;

class VisitAllResponse 
{
    private int $id;
    private int $propertyId;
    private int $clientId;
    private \DateTime $visitDate;
    private string $status;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getPropertyId(): int
    {
        return $this->propertyId;
    }

    public function setPropertyId(int $propertyId): void
    {
        $this->propertyId = $propertyId;
    }  
    public function getClientId(): int
    {
        return $this->clientId;
    }
    public function setClientId(int $clientId): void
    {
        $this->clientId = $clientId;
    }
    public function getVisitDate(): \DateTime
    {
        return $this->visitDate;
    }

    public function setVisitDate(\DateTime $visitDate): void
    {
        $this->visitDate = $visitDate;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}