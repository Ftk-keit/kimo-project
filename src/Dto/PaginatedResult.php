<?php

namespace App\Dto;

class PaginatedResult
{
    private array $items;
    private int $currentPage;
    private int $totalPages;
    private int $totalItems;
    private int $itemsPerPage;

    public function __construct(
        array $items,
        int $currentPage,
        int $totalPages,
        int $totalItems,
        int $itemsPerPage
    ) {
        $this->items = $items;
        $this->currentPage = $currentPage;
        $this->totalPages = $totalPages;
        $this->totalItems = $totalItems;
        $this->itemsPerPage = $itemsPerPage;
    }

    public static function create(array $items, int $currentPage, int $totalItems, int $itemsPerPage): self
    {
        $totalPages = ceil($totalItems / $itemsPerPage) ?: 1;

        return new self(
            items: $items,
            currentPage: $currentPage,
            totalPages: $totalPages,
            totalItems: $totalItems,
            itemsPerPage: $itemsPerPage
        );
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    public function getTotalPages(): int
    {
        return $this->totalPages;
    }

    public function getTotalItems(): int
    {
        return $this->totalItems;
    }

    public function isFirst(): bool
    {
        return $this->currentPage === 1;
    }

    public function isLast(): bool
    {
        return $this->currentPage === $this->totalPages;
    }

    public function toArray(): array
    {
        return [
            'items' => $this->items,
            'currentPage' => $this->currentPage,
            'totalPages' => $this->totalPages,
            'totalItems' => $this->totalItems,
            'first' => $this->isFirst(),
            'last' => $this->isLast(),
        ];
    }
}
