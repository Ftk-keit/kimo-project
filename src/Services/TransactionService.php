<?php

namespace App\Services;

interface TransactionService 
{
    public function createTransaction(createTransaction $createTransaction): Transaction;
    public function getTransactionById(int $id): ?Transaction;
    public function updateTransaction(int $id, updateTransaction $updateTransaction): ?Transaction;
    public function deleteTransaction(int $id): bool;
}