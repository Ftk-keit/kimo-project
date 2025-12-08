<?php

namespace App\Services;

interface AuthService 
{
    public function register(register $register): User;
    public function login(login $login): User;
}