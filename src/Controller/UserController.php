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
        $users = $this->userService->getAllUsers();
        return $this->json($users);
    }

    #[Route('/{id}', name: 'get_user', methods: ['GET'])]
    public function get(int $id): JsonResponse
    {
        $user = $this->userService->getUserById($id);
        
        if (!$user) {
            return $this->json(['error' => 'User not found'], Response::HTTP_NOT_FOUND);
        }
        
        return $this->json($user);
    }

    #[Route('/{id}', name: 'update_user', methods: ['PUT'])]
    public function update(int $id, Register $registerDto): JsonResponse
    {
        $response = $this->userService->update($id, $registerDto);
        return $this->json($response);
    }

    #[Route('/{id}', name: 'delete_user', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $this->userService->delete($id);
        return $this->json(['message' => 'User deleted successfully'], Response::HTTP_OK);
    }
}
