<?php

namespace App\Services;

use App\Dto\Requests\Login;
use App\Dto\Requests\Register;

interface AuthService 
{
    public function register(Register $register): array;
    public function login(Login $login): array;
}