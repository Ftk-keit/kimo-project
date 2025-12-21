<?php

namespace App\Utils\Mappers;

use App\Dto\Requests\register;
use App\Dto\Responses\UserAllResponse;
use App\Entity\User;

class UserMapper
{
    public static function toDto(User $user): UserAllResponse
    {
        $dto = new UserAllResponse();
        $dto->setId($user->getId());
        $dto->setEmail($user->getEmail());
        $dto->setName($user->getName());
        $dto->setFirstname($user->getFirstname());
        $dto->setPhone($user->getPhone());
        $dto->setAddress($user->getAddress());

        return $dto;
    }

    public static function toEntity(register $dto): User
    {
        $user = new User();
        $user->setEmail($dto->getEmail());
        $user->setPassword($dto->getPassword());
        $user->setName($dto->getName());
        $user->setFirstname($dto->getFirstname());
        $user->setPhone($dto->getPhone());
        $user->setAddress($dto->getAddress());

        return $user;
    }
}
