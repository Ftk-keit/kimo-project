<?php

namespace App\Enums;

enum StatusTransaction: string
{
    case COMPLET = 'Complet';
    case EN_COURS = 'En cours';
    case ECHEC = 'Échoué';
        public static function toEnum(string $value): ?StatusTransaction
    {
        $status = strtolower($value);
        switch ($status) {
            case "complet":
                return self::COMPLET;
            case "en cours":
                return self::EN_COURS;
            case "échoué":
                return self::ECHEC;
            default:
               null;
            }
    }
}