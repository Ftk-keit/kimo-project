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

    public function update(int $userId, Register $register): array
    {
        $response = [];
        $user = $this->userRepository->findById($userId);
        
        if (!$user) {
            $response['message'] = 'User not found';
            return $response;
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
        
        $response['message'] = 'User updated successfully';
        $response['content'] = $this->userMapper->toDto($user);
        return $response;
    }

    public function delete(int $userId): array
    {
        $response = [];
        $user = $this->userRepository->findById($userId);
        
        if (!$user) {
            $response['message'] = 'User not found';
            return $response;
        }
        
        $response['content'] = $this->userMapper->toDto($user);
        $this->userRepository->delete($user);
        $response['message'] = 'User deleted successfully';
        return $response;
    }

    public function getAllUsers(): array
    {
        $response = [];
        $users = $this->userRepository->findAll();
        
        if (!$users) {
            $response['message'] = 'No users found';
            return $response;
        }
        
        $response['message'] = 'Users found successfully';
        $response['content'] = array_map(fn($user) => $this->userMapper->toDto($user), $users);
        return $response;
    }

    public function getUserById(int $userId): array
    {
        $response = [];
        $user = $this->userRepository->findById($userId);
        
        if (!$user) {
            $response['message'] = 'User not found';
            return $response;
        }
        
        $response['message'] = 'User found successfully';
        $response['content'] = $this->userMapper->toDto($user);
        return $response;
    }
}
