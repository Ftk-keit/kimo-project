<?php

namespace App\Enums;

enum StatusVisit: string
{
    case CONFIRME = 'Confirmé';
    case ANNULE = 'Annulé';
    case EN_ATTENTE = 'En attente';
    public static function toEnum(string $value): ?StatusVisit
    {
        $status = strtolower($value);
        switch ($status) {
            case "confirmé":
                return self::CONFIRME;
            case "annulé":
                return self::ANNULE;
            case "en attente":
                return self::EN_ATTENTE;
            default:
                null;

        }
    }
}