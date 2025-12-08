<?php
namespace App\Enums;

enum TypeProperty: string
{
    case Appartement = 'Appartement';
    case Maison = 'Maison';
    case studio = 'Studio';
    case Bureau = 'Bureau';
    case Colocation = 'Colocation';
}