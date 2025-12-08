<?php

namespace App\Services;

use App\Dto\Requests\register;
use App\Dto\Responses\UserAllResponse;
use App\Entity\User;

interface UserService
{

    public function update(int $userId, register $register): UserAllResponse; 
    public function delete(int $userId): void;
    public function getAllUsers(): array;
    public function getUserById(int $userId): ?User;
}