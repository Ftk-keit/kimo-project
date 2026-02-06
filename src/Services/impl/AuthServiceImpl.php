<?php

namespace App\Services\impl;

use App\Dto\Requests\Login;
use App\Dto\Requests\Register;
use App\Entity\User;
use App\Enums\TypeAccount;
use App\Repository\UserRepository;
use App\Services\AuthService;
use App\Utils\Mappers\UserMapper;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AuthServiceImpl implements AuthService
{
    public function __construct(
        private UserRepository $userRepository,
        private UserMapper $userMapper,
        private UserPasswordHasherInterface $passwordHasher,
    ) {
    }

    public function register(Register $register): array
    {
        $response = [];

        $existingUser = $this->userRepository->findByEmail($register->getEmail());
        if ($existingUser) {
            $response['message'] = 'User with this email already exists';
            return $response;
        }

        $user = $this->userMapper->toEntity($register);
        $hashedPassword = $this->passwordHasher->hashPassword($user, $register->getPassword());
        $user->setPassword($hashedPassword);

        $this->userRepository->save($user);

        $response['message'] = 'User registered successfully';
        $response['content'] = $this->userMapper->toDto($user);
        return $response;
    }

    public function login(Login $login): array
    {
        $response = [];

        $user = $this->userRepository->findByEmail($login->getUsername());
        if (!$user) {
            $response['message'] = 'Invalid email or password';
            return $response;
        }

        if (!$this->passwordHasher->isPasswordValid($user, $login->getPassword())) {
            $response['message'] = 'Invalid email or password';
            return $response;
        }

        $response['message'] = 'Login successful';
        $response['content'] = $this->userMapper->toDto($user);
        return $response;
    }
}
