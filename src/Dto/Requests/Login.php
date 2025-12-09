<?php

namespace App\Dto\Requests;

use Symfony\Component\Validator\Constraints as Assert;
class Login
{
    #[Assert\NotBlank(message: 'Username is required')]
    private string $username;

    #[Assert\NotBlank(message: 'Password is required')]
    private string $password;

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}