<?php

namespace App\Services;

use App\Dto\Requests\TransactionDto;
use App\Dto\Responses\TransactionAllResponse;

interface TransactionService 
{
    public function createTransaction(TransactionDto $createTransaction): array;
    public function getTransactionById(int $id): array;
    public function getAllTransactions(): array;
    public function updateTransaction(int $id, TransactionDto $updateTransaction): array;
    public function deleteTransaction(int $id): array;
}