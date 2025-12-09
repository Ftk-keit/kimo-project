<?php

namespace App\Dto\Responses;

class TransactionAllResponse 
{
    private int $id;
    private ?int $sellerId;
    private ?int $buyerId;
    private ?int $amount;
    private ?int $propertyId;
    private ?string $commission;
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
}