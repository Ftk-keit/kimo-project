<?php

namespace App\Dto\Requests;

use Symfony\Component\Validator\Constraints as Assert;

class TransactionDto
{
    #[Assert\NotBlank(message: 'SellerId is required')]
    #[Assert\NotNull(message:'SellerId is required')]
    private ?int $sellerId;

    #[Assert\NotBlank(message: 'BuyerId is required')]
    #[Assert\NotNull(message:'BuyerId is required')]
    private ?int $buyerId;

    #[Assert\NotBlank(message: 'Amount is required')]
    #[Assert\NotNull(message:'Amount is required')]
    private ?int $amount;

    #[Assert\NotBlank(message: 'Price is required')]
    #[Assert\NotNull(message:'Price is required')]
    private ?float $price;

    #[Assert\NotBlank(message: 'PropertyId is required')]
    #[Assert\NotNull(message:'PropertyId is required')]
    private ?int $propertyId;

    #[Assert\NotBlank(message: 'Commission is required')]
    #[Assert\NotNull(message:'Commission is required')]
    private ?string $commission;

    #[Assert\NotBlank(message: 'Date is required')]
    #[Assert\NotNull(message:'Date is required')]
    private ?\DateTime $date;

    #[Assert\NotBlank(message: 'Status is required')]
    #[Assert\NotNull(message:'Status is required')]
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