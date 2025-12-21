<?php

namespace App\Enums;

enum TypeTransaction: string
{
    case VENTE = 'Vente';
    case LOCATION = 'Location';

    public static function toEnum(string $value): ?TypeTransaction
    {
        $status = strtolower($value);
        switch ($status) {
            case "vente":
                return self::VENTE;
            case "location":
                return self::LOCATION;
            default:
                return null;
        }
    }
}