<?php
namespace App\Enums;

enum TypeAccount: string
{
    case ADMIN = 'ROLE_ADMIN';
    case USER = 'ROLE_USER';
    case OWNER = 'ROLE_OWNER';
    case AGENT = 'ROLE_AGENT';
    case CLIENT = 'ROLE_CLIENT';
}