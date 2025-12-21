<?php

namespace App\Services;

use App\Dto\Requests\TransactionDto;
use App\Dto\Responses\TransactionAllResponse;

interface TransactionService 
{
    public function createTransaction(TransactionDto $createTransaction): ?TransactionAllResponse;
    public function getTransactionById(int $id): ?TransactionAllResponse;
    public function getAllTransactions(): ?array;

    public function updateTransaction(int $id, TransactionDto $updateTransaction): ?TransactionAllResponse;
    public function deleteTransaction(int $id): bool;
}