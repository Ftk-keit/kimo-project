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

    public function createTransaction(TransactionDto $createTransaction): array
    {
        $response = [];
        $transaction = $this->transactionMapper->toEntity($createTransaction);
        $sellerId = $this->userRepository->findById($createTransaction->getSellerId());
        $buyerId = $this->userRepository->findById($createTransaction->getBuyerId());
        $propertyId = $this->propertyRepository->findById($createTransaction->getPropertyId());
        if ($buyerId === null || $sellerId === null || $propertyId === null) {
            $response['message'] = 'Seller, buyer or property not found';
            return $response;
        }
        $transaction->setSeller($sellerId);
        $transaction->setBuyer($buyerId);
        $transaction->setProperty($propertyId);

        $this->transactionRepository->save($transaction);

        $response['message'] = 'Transaction created successfully';
        $response['content'] = $this->transactionMapper->toDto($transaction);
        return $response;
    }

    public function getTransactionById(int $id): array
    {
        $response = [];
        $transaction = $this->transactionRepository->findById($id);

        if (!$transaction) {
            $response['message'] = 'Transaction not found';
            return $response;
        }

        $response['message'] = 'Transaction found successfully';
        $response['content'] = $this->transactionMapper->toDto($transaction);
        return $response;
    }

    public function updateTransaction(int $id, TransactionDto $updateTransaction): array
    {
        $response = [];
        $transaction = $this->transactionRepository->findById($id);

        if (!$transaction) {
            $response['message'] = 'Transaction not found';
            return $response;
        }
        $sellerId = $this->userRepository->findById($updateTransaction->getSellerId());
        $buyerId = $this->userRepository->findById($updateTransaction->getBuyerId());
        $propertyId = $this->propertyRepository->findById($updateTransaction->getPropertyId());
        if ($buyerId === null || $sellerId === null || $propertyId === null) {
            $response['message'] = 'Seller, buyer or property not found';
            return $response;
        }

        $transaction->setPrice($updateTransaction->getPrice());
        $transaction->setCommission($updateTransaction->getCommission());
        $transaction->setAmount($updateTransaction->getAmount());
        $transaction->setDate($updateTransaction->getDate());
        $transaction->setSeller($sellerId);
        $transaction->setBuyer($buyerId);
        $transaction->setProperty($propertyId);

        $this->transactionRepository->update($transaction);

        $response['message'] = 'Transaction updated successfully';
        $response['content'] = $this->transactionMapper->toDto($transaction);
        return $response;
    }

    public function deleteTransaction(int $id): array
    {
        $response = [];
        $transaction = $this->transactionRepository->findById($id);

        if (!$transaction) {
            $response['message'] = 'Transaction not found';
            return $response;
        }

        $response['content'] = $this->transactionMapper->toDto($transaction);
        $this->transactionRepository->deleteById($id);
        $response['message'] = 'Transaction deleted successfully';

        return $response;
    }

    public function getAllTransactions(): array
    {
        $response = [];
        $transactions = $this->transactionRepository->findAll();

        if (!$transactions) {
            $response['message'] = 'No transactions found';
            return $response;
        }

        $response['message'] = 'Transactions found successfully';
        $response['content'] = array_map([$this->transactionMapper, 'toDto'], $transactions);
        return $response;
    }
}
