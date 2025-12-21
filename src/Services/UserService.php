<?php

namespace App\Services;

use App\Dto\Requests\Register;
use App\Dto\Responses\UserAllResponse;
use App\Entity\User;

interface UserService
{
    public function update(int $userId, Register $register): UserAllResponse; 
    public function delete(int $userId): void;
    public function getAllUsers(): array;
    public function getUserById(int $userId): ?User;
}