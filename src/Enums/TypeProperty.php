<?php
namespace App\Enums;

enum TypeProperty: string
{
    case Appartement = 'Appartement';
    case Maison = 'Maison';
    case studio = 'Studio';
    case Bureau = 'Bureau';
    case Colocation = 'Colocation';

    public static function toEnum(string $value): ?TypeProperty
    {
        $status = strtolower($value);
        switch ($status) {
            case "appartement":
                return self::Appartement;
            case "maison":
                return self::Maison;
            case "studio":
                return self::studio;
            case "bureau":
                return self::Bureau;
            case "colocation":
                return self::Colocation;
            default:
                return null;
        }
    }
}