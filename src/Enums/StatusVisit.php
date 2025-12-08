<?php

namespace App\Enums;

enum StatusVisit: string
{
    case CONFIRME = 'Confirmé';
    case ANNULE = 'Annulé';
    case EN_ATTENTE = 'En attente';
}