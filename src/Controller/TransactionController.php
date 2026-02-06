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

    #[Route('', name: 'create_transaction', methods: ['POST'])]
    public function create(TransactionDto $transactionDto): JsonResponse
    {
        $response = $this->transactionService->createTransaction($transactionDto);
        if (!isset($response['content'])) {
            return $this->json($response['message'], Response::HTTP_BAD_REQUEST);
        }
        return $this->json($response['content'], Response::HTTP_CREATED);
    }

    #[Route('/{id}', name: 'get_transaction', methods: ['GET'])]
    public function get(int $id): JsonResponse
    {
        $response = $this->transactionService->getTransactionById($id);
        if (!isset($response['content'])) {
            return $this->json($response['message'], Response::HTTP_NOT_FOUND);
        }
        return $this->json($response['content'], Response::HTTP_OK);
    }

    #[Route('/', name: 'get_all_transactions', methods: ['GET'])]
    public function getAll(): JsonResponse
    {
        $response = $this->transactionService->getAllTransactions();
        if (!isset($response['content'])) {
            return $this->json($response['message'], Response::HTTP_NOT_FOUND);
        }
        return $this->json($response['content'], Response::HTTP_OK);
    }

    #[Route('/{id}', name: 'update_transaction', methods: ['PUT'])]
    public function update(int $id, TransactionDto $transactionDto): JsonResponse
    {
        $response = $this->transactionService->updateTransaction($id, $transactionDto);
        if (!isset($response['content'])) {
            return $this->json($response['message'], Response::HTTP_BAD_REQUEST);
        }
        return $this->json($response['content'], Response::HTTP_OK);
    }

    #[Route('/{id}', name: 'delete_transaction', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $response = $this->transactionService->deleteTransaction($id);
        if (!isset($response['content'])) {
            return $this->json($response['message'], Response::HTTP_NOT_FOUND);
        }
        return $this->json($response['content'], Response::HTTP_OK);
    }
}
