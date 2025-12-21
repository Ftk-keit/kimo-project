<?php

namespace App\Services\impl;

use App\Dto\Requests\Register;
use App\Dto\Responses\UserAllResponse;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Services\UserService;
use App\Utils\Mappers\UserMapper;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserServiceImpl implements UserService
{
    private UserRepository $userRepository;
    private UserMapper $userMapper;
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(
        UserRepository $userRepository,
        UserMapper $userMapper,
        UserPasswordHasherInterface $passwordHasher
    ) {
        $this->userRepository = $userRepository;
        $this->userMapper = $userMapper;
        $this->passwordHasher = $passwordHasher;
    }

    public function update(int $userId, Register $register): UserAllResponse
    {
    
        $user = $this->userRepository->findById($userId);
        
        if (!$user) {
            throw new \Exception("User not found with id: $userId");
        }
        
        $user->setEmail($register->getEmail());
        $user->setName($register->getName());
        $user->setFirstname($register->getFirstname());
        $user->setPhone($register->getPhone());
        $user->setAddress($register->getAddress());
        
        if ($register->getPassword()) {
            $hashedPassword = $this->passwordHasher->hashPassword($user, $register->getPassword());
            $user->setPassword($hashedPassword);
        }
        
        $this->userRepository->update($user);
        
        return $this->userMapper->toDto($user);
    }

    public function delete(int $userId): void
    {
        $user = $this->userRepository->findById($userId);
        
        if (!$user) {
            throw new \Exception("User not found with id: $userId");
        }
        
        $this->userRepository->delete($user);
    }

    public function getAllUsers(): array
    {
        $users = $this->userRepository->findAll();
        
        $userResponses = [];
        foreach ($users as $user) {
            $userResponses[] = $this->userMapper->toDto($user);
        }
        
        return $userResponses;
    }

    public function getUserById(int $userId): ?User
    {
        return $this->userRepository->findById($userId);
    }
}
