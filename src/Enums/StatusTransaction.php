<?php

namespace App\Enums;

enum StatusTransaction: string
{
    case COMPLET = 'Complet';
    case EN_COURS = 'En cours';
    case ECHEC = 'Échoué';
}