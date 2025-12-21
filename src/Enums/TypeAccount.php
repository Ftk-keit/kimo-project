<?php
namespace App\Enums;

enum TypeAccount: string
{
    case ADMIN = 'ROLE_ADMIN';
    case USER = 'ROLE_USER';
    case OWNER = 'ROLE_OWNER';
    case AGENT = 'ROLE_AGENT';
    case CLIENT = 'ROLE_CLIENT';

    public function toEnum(string $value): ?TypeAccount
    {
        $status = strtolower($value);
        switch ($status) {
            case "role_admin":
                return self::ADMIN;
            case "role_user":
                return self::USER;
            case "role_owner":
                return self::OWNER;
            case "role_agent":
                return self::AGENT;
            case "role_client":
                return self::CLIENT;
            default:
                return null;
        }
    }
}