<?php

namespace App\Dto;

use Symfony\Component\HttpFoundation\Response;

class RestResponse
{
    public static function response(int $status, mixed $results, string $type = 'success'): array
    {
        return [
            'status' => $status,
            'type' => $type,
            'results' => $results,
        ];
    }

    public static function responsePaginate(
        int $status,
        mixed $results,
        int $currentPage,
        int $totalPages,
        int $totalItems,
        bool $first,
        bool $last,
        string $type = 'success'
    ): array {
        return [
            'status' => $status,
            'type' => $type,
            'results' => $results,
            'pagination' => [
                'currentPage' => $currentPage,
                'totalPages' => $totalPages,
                'totalItems' => $totalItems,
                'first' => $first,
                'last' => $last,
            ],
        ];
    }

    /**
     * Response d'erreur
     */
    public static function error(int $status, string $message, string $type = 'error'): array
    {
        return [
            'status' => $status,
            'type' => $type,
            'message' => $message,
        ];
    }
}
