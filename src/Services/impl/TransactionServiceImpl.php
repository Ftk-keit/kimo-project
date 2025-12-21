<?php

namespace App\Services\impl;

use App\Dto\Requests\TransactionDto;
use App\Dto\Responses\TransactionAllResponse;
use App\Entity\Transaction;
use App\Repository\PropertyRepository;
use App\Repository\TransactionRepository;
use App\Repository\UserRepository;
use App\Services\TransactionService;
use App\Utils\Mappers\TransactionMapper;

class TransactionServiceImpl implements TransactionService
{
    private TransactionRepository $transactionRepository;
    private TransactionMapper $transactionMapper;
    private UserRepository $userRepository;
    private PropertyRepository $propertyRepository;

    public function __construct(
        TransactionRepository $transactionRepository,
        TransactionMapper $transactionMapper,
        UserRepository $userRepository,
        PropertyRepository $propertyRepository
    ) {
        $this->transactionRepository = $transactionRepository;
        $this->transactionMapper = $transactionMapper;
        $this->userRepository = $userRepository;
        $this->propertyRepository = $propertyRepository;
    }

    public function createTransaction(TransactionDto $createTransaction): ?TransactionAllResponse
    {
        $transaction = $this->transactionMapper->toEntity($createTransaction);
        $sellerId = $this->userRepository->findById($createTransaction->getSellerId());
        $buyerId = $this->userRepository->findById($createTransaction->getBuyerId());
        $propertyId = $this->propertyRepository->findById($createTransaction->getPropertyId());
        if ($buyerId === null || $sellerId === null || $propertyId === null) {
            return null;
        }
        $transaction->setSeller($sellerId);
        $transaction->setBuyer($buyerId);
        $transaction->setProperty($propertyId);

        $this->transactionRepository->save($transaction);

        return $this->transactionMapper->toDto($transaction);
    }

    public function getTransactionById(int $id): ?TransactionAllResponse
    {

        $transaction = $this->transactionRepository->findById($id);

        if (!$transaction) {
            return null;
        }

        return $this->transactionMapper->toDto($transaction);
    }

    public function updateTransaction(int $id, TransactionDto $updateTransaction): ?TransactionAllResponse
    {
        $transaction = $this->transactionRepository->findById($id);

        if (!$transaction) {
            return null;
        }
        $sellerId = $this->userRepository->findById($updateTransaction->getSellerId());
        $buyerId = $this->userRepository->findById($updateTransaction->getBuyerId());
        $propertyId = $this->propertyRepository->findById($updateTransaction->getPropertyId());
        if ($buyerId === null || $sellerId === null || $propertyId === null) {
            return null;
        }

        $transaction->setPrice($updateTransaction->getPrice());
        $transaction->setCommission($updateTransaction->getCommission());
        $transaction->setAmount($updateTransaction->getAmount());
        $transaction->setDate($updateTransaction->getDate());
        $transaction->setSeller($sellerId);
        $transaction->setBuyer($buyerId);
        $transaction->setProperty($propertyId);

        $this->transactionRepository->update($transaction);

        return $this->transactionMapper->toDto($transaction);
    }

    public function deleteTransaction(int $id): bool
    {
        $transaction = $this->transactionRepository->findById($id);

        if (!$transaction) {
            return false;
        }

        $this->transactionRepository->deleteById($id);

        return true;
    }

    public function getAllTransactions(): ?array
    {
        $transactions = $this->transactionRepository->findAll();

        if (!$transactions) {
            return null;
        }

        return array_map([$this->transactionMapper, 'toDto'], $transactions);
    }
}
