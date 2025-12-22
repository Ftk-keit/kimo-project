<?php

namespace App\Controller;

use App\Dto\Requests\TransactionDto;
use App\Services\TransactionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/transactions')]
final class TransactionController extends AbstractController
{
    public function __construct(private TransactionService $transactionService)
    {
    }

    #[Route('', name: 'create_transaction', methods: ['POST'])] //ok
    public function create(TransactionDto $transactionDto): JsonResponse
    {
        $response = $this->transactionService->createTransaction($transactionDto);
        return $this->json($response, Response::HTTP_CREATED);
    }

    #[Route('/{id}', name: 'get_transaction', methods: ['GET'])] //ok
    public function get(int $id): JsonResponse
    {
        $transaction = $this->transactionService->getTransactionById($id);
        
        if (!$transaction) {
            return $this->json(['error' => 'Transaction not found'], Response::HTTP_NOT_FOUND);
        }
        
        return $this->json($transaction);
    }

    #[Route('/', name: 'get_all_transactions', methods: ['GET'])] //ok
    public function getAll(): JsonResponse
    {
        $transactions = $this->transactionService->getAllTransactions();
        
        if (!$transactions) {
            return $this->json(['error' => 'Transaction not found'], Response::HTTP_NOT_FOUND);
        }
        
        return $this->json($transactions);
    }

    #[Route('/{id}', name: 'update_transaction', methods: ['PUT'])] //ok
    public function update(int $id, TransactionDto $transactionDto): JsonResponse
    {
        $response = $this->transactionService->updateTransaction($id, $transactionDto);
        
        if (!$response) {
            throw new \Exception('Transaction not found', 404);
        }
        
        return $this->json($response);
    }

    #[Route('/{id}', name: 'delete_transaction', methods: ['DELETE'])] //ok
    public function delete(int $id): JsonResponse
    {
        $deleted = $this->transactionService->deleteTransaction($id);
        
        if (!$deleted) {
            throw new \Exception('Transaction not found', 404);
        }
        
        return $this->json(['message' => 'Transaction deleted successfully'], Response::HTTP_OK);
    }
}
