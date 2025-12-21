<?php

namespace App\Dto\Requests;

use Symfony\Component\Validator\Constraints as Assert;
class VisitDto 
{
    #[Assert\NotBlank(message: 'PropertyId is required')]
    private ?int $propertyId;

    #[Assert\NotBlank(message:'ClientId is required')]
    private ?int $clientId;

    #[Assert\NotBlank(message:'Date is required')]
    private ?\DateTime $visitDate;

     #[Assert\NotBlank(message:'Date is required')]
    private ?\DateTime $hourse;
    #[Assert\NotBlank(message:'Status is required')]
    private ?string $status;


    public function getPropertyId(): ?int
    {
        return $this->propertyId;
    }
    public function getClientId(): ?int
    {
        return $this->clientId;
    }
    public function getVisitDate(): ?\DateTime
    {
        return $this->visitDate;
    }
    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getHourse(): ?\DateTime
    {
        return $this->hourse;
    }

    public function setPropertyId(?int $propertyId): void
    {
        $this->propertyId = $propertyId;
    }
    public function setClientId(?int $clientId): void
    {
        $this->clientId = $clientId;
            
    }
    public function setVisitDate(?string $visitDate): void
    {
        $this->visitDate = $visitDate !== null ? new \DateTime($visitDate) : null;
    }
    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    public function getDate(): ?\DateTime
    {
        return $this->visitDate;
    }
    public function setHourse(?string $hourse): void
    {
        $this->hourse = $hourse !== null ? new \DateTime($hourse) : null;
    }
}