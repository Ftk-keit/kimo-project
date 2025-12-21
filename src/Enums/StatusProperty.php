<?php
namespace App\Enums;

enum StatusProperty: string
{
    case PUBLIE = 'Publié';
    case NON_PUBLIE = 'Non Publié';

    public static function toEnum(string $value): ?StatusProperty
    {
        $status = strtolower($value);
        switch ($status) {
            case "publié":
                return self::PUBLIE;
            case "non publié":
                return self::NON_PUBLIE;
            default:
               null;
            }
       
    }
    


}

