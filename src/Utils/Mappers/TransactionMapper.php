<?php

namespace App\Utils\Mappers;

use App\Dto\Requests\TransactionDto;
use App\Dto\Responses\TransactionAllResponse;
use App\Entity\Transaction;
use App\Enums\StatusTransaction;

class TransactionMapper
{
    public static function toDto(Transaction $transaction): TransactionAllResponse
    {
        $dto = new TransactionAllResponse();
        $dto->setId($transaction->getId());
        $dto->setAmount($transaction->getAmount());
        $dto->setCommission($transaction->getCommission());
        $dto->setDate($transaction->getDate());
        $dto->setPrice($transaction->getPrice());
        $dto->setStatus($transaction->getStatus()->value);
        $dto->setAmount($transaction->getAmount());
        $dto->setSellerId($transaction->getSeller()->getId());
        $dto->setBuyerId($transaction->getBuyer()->getId());
        $dto->setPropertyId($transaction->getProperty()->getId());

        return $dto;
    }

    public static function toEntity(TransactionDto $dto): Transaction
    {
        $transaction = new Transaction();
        $status = StatusTransaction::toEnum($dto->getStatus());
        $transaction->setStatus($status);
        $transaction->setAmount($dto->getAmount());
        $transaction->setCommission($dto->getCommission());
        $transaction->setDate($dto->getDate());
        $transaction->setPrice($dto->getPrice());
        $transaction->setAmount($dto->getAmount());

        return $transaction;
    }
}
