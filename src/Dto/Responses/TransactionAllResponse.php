<?php

namespace App\Dto\Responses;

use PhpParser\Node\Expr\Cast\Double;

class TransactionAllResponse 
{
    private int $id;
    private ?int $sellerId;
    private ?int $buyerId;
    private ?int $amount;
    private ?int $propertyId;
    private ?string $commission;
    private ?float $price;
    private ?\DateTime $date;
    private ?string $status;

    public function getId(): int
    {
        return $this->id;
    }

    public function getSellerId(): ?int
    {
        return $this->sellerId;
    }

    public function getBuyerId(): ?int
    {
        return $this->buyerId;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function getPropertyId(): ?int
    {
        return $this->propertyId;
    }
    public function getCommission(): ?string
    {
        return $this->commission;
    }
    public function getDate(): ?\DateTime
    {
        return $this->date;
    }
    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setSellerId(?int $sellerId): void
    {
        $this->sellerId = $sellerId;
    }

    public function setBuyerId(?int $buyerId): void
    {
        $this->buyerId = $buyerId;
    }

    public function setAmount(?int $amount): void
    {
        $this->amount = $amount;
    }

    public function setPropertyId(?int $propertyId): void
    {
        $this->propertyId = $propertyId;
    }

    public function setCommission(?string $commission): void
    {
        $this->commission = $commission;
    }

    public function setDate(?\DateTime $date): void
    {
        $this->date = $date;
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