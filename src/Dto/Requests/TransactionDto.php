<?php

namespace App\Dto\Requests;

class TransactionDto
{
    private ?int $sellerId;
    private ?int $buyerId;
    private ?int $amount;

    private ?int $propertyId;
    private ?string $commission;
    private ?\DateTime $date = new \DateTime();
    private ?string $status;
    function getSellerId(): ?int
    {
        return $this->sellerId;
    }
    
    function setSellerId(?int $sellerId): void
    {
        $this->sellerId = $sellerId;
    }

    function getBuyerId(): ?int
    {
        return $this->buyerId;
    }
    function setBuyerId(?int $buyerId): void
    {
        $this->buyerId = $buyerId;
    }
    function getAmount(): ?int
    {
        return $this->amount;
    }
    function setAmount(?int $amount): void
    {
        $this->amount = $amount;
    }
    function getPropertyId(): ?int
    {
        return $this->propertyId;
    
    }
    function setPropertyId(?int $propertyId): void
    {
        $this->propertyId = $propertyId;
    }
    function getCommission(): ?string
    {
        return $this->commission;
    }
    function setCommission(?string $commission): void
    {
        $this->commission = $commission;
    }
    function getDate(): ?\DateTime
    {
        return $this->date;
    }
    function setDate(?\DateTime $date): void
    {
        $this->date = $date;
    }
    function getStatus(): ?string
    {
        return $this->status;
    }
    function setStatus(?string $status): void
    {
        $this->status = $status;
    }


}