<?php

namespace App\Controller;

use App\Dto\Requests\Login;
use App\Dto\Requests\Register;
use App\Services\AuthService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/auth')]
final class AuthController extends AbstractController
{
    public function __construct(private AuthService $authService)
    {
    }

    #[Route('/register', name: 'register', methods: ['POST'])]
    public function register(Register $registerDto): JsonResponse
    {
        $response = $this->authService->register($registerDto);
        if (!isset($response['content'])) {
            return $this->json($response['message'], Response::HTTP_BAD_REQUEST);
        }
        return $this->json($response['content'], Response::HTTP_CREATED);
    }

    #[Route('/login', name: 'login', methods: ['POST'])]
    public function login(Login $loginDto): JsonResponse
    {
        $response = $this->authService->login($loginDto);
        if (!isset($response['content'])) {
            return $this->json($response['message'], Response::HTTP_UNAUTHORIZED);
        }
        return $this->json($response['content'], Response::HTTP_OK);
    }
}
