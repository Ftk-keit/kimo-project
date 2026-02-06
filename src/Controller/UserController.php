<?php

namespace App\Controller;

use App\Dto\Requests\Register;
use App\Services\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/users')]
final class UserController extends AbstractController
{
    public function __construct(private UserService $userService)
    {
    }

    #[Route('', name: 'get_all_users', methods: ['GET'])]
    public function getAll(): JsonResponse
    {
        $response = $this->userService->getAllUsers();
        if (!isset($response['content'])) {
            return $this->json($response['message'], Response::HTTP_NOT_FOUND);
        }
        return $this->json($response['content'], Response::HTTP_OK);
    }

    #[Route('/{id}', name: 'get_user', methods: ['GET'])]
    public function get(int $id): JsonResponse
    {
        $response = $this->userService->getUserById($id);
        if (!isset($response['content'])) {
            return $this->json($response['message'], Response::HTTP_NOT_FOUND);
        }
        return $this->json($response['content'], Response::HTTP_OK);
    }

    #[Route('/{id}', name: 'update_user', methods: ['PUT'])]
    public function update(int $id, Register $registerDto): JsonResponse
    {
        $response = $this->userService->update($id, $registerDto);
        if (!isset($response['content'])) {
            return $this->json($response['message'], Response::HTTP_BAD_REQUEST);
        }
        return $this->json($response['content'], Response::HTTP_OK);
    }

    #[Route('/{id}', name: 'delete_user', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $response = $this->userService->delete($id);
        if (!isset($response['content'])) {
            return $this->json($response['message'], Response::HTTP_NOT_FOUND);
        }
        return $this->json($response['content'], Response::HTTP_OK);
    }
}
