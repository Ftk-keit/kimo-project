<?php

namespace App\Dto\Requests;


class TransactionDto
{
    private ?int $sellerId;
    private ?int $buyerId;
    private ?int $amount;
    private ?float $price;
    private ?int $propertyId;
    private ?string $commission;
    private ?\DateTime $date;
    private ?string $status;
   public function getSellerId(): ?int
    {
        return $this->sellerId;
    }

    public function setSellerId(?int $sellerId): void
    {
        $this->sellerId = $sellerId;
    }

    public function getBuyerId(): ?int
    {
        return $this->buyerId;
    }
    public function setBuyerId(?int $buyerId): void
    {
        $this->buyerId = $buyerId;
    }
    public function getAmount(): ?int
    {
        return $this->amount;
    }
    public function setAmount(?int $amount): void
    {
        $this->amount = $amount;
    }
    public function getPropertyId(): ?int
    {
        return $this->propertyId;

    }
    public function setPropertyId(?int $propertyId): void
    {
        $this->propertyId = $propertyId;
    }
    public function getCommission(): ?string
    {
        return $this->commission;
    }
    public function setCommission(?string $commission): void
    {
        $this->commission = $commission;
    }
    public function getDate(): ?\DateTime
    {
        return $this->date;
    }
    public function setDate(?\DateTime $date): void
    {
        $this->date = $date;
    }
    public function getStatus(): ?string
    {
        return $this->status;
    }
    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): void
    {
        $this->price = $price;
    }
}