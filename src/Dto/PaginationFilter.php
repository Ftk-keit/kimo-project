<?php

namespace App\Dto;

class PaginationFilter
{
    private int $page = 1;
    private int $limit = 10;
    private string $sortBy = 'id';
    private string $sortOrder = 'ASC';
    private array $filters = [];

    public function __construct(
        ?int $page = null,
        ?int $limit = null,
        ?string $sortBy = null,
        ?string $sortOrder = null,
        ?array $filters = null
    ) {
        if ($page !== null && $page > 0) {
            $this->page = $page;
        }
        if ($limit !== null && $limit > 0) {
            $this->limit = min($limit, 100); 
        }
        if ($sortBy !== null) {
            $this->sortBy = $sortBy;
        }
        if ($sortOrder !== null && in_array(strtoupper($sortOrder), ['ASC', 'DESC'])) {
            $this->sortOrder = strtoupper($sortOrder);
        }
        if ($filters !== null) {
            $this->filters = $filters;
        }
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getOffset(): int
    {
        return ($this->page - 1) * $this->limit;
    }

    public function getSortBy(): string
    {
        return $this->sortBy;
    }

    public function getSortOrder(): string
    {
        return $this->sortOrder;
    }

    public function getFilters(): array
    {
        return $this->filters;
    }

    public function getFilter(string $key, mixed $default = null): mixed
    {
        return $this->filters[$key] ?? $default;
    }

    public function hasFilter(string $key): bool
    {
        return isset($this->filters[$key]) && !empty($this->filters[$key]);
    }

    public static function fromRequest(array $queryParams): self
    {
        return new self(
            page: (int)($queryParams['page'] ?? 1),
            limit: (int)($queryParams['limit'] ?? 10),
            sortBy: $queryParams['sortBy'] ?? 'id',
            sortOrder: $queryParams['sortOrder'] ?? 'ASC',
            filters: self::extractFilters($queryParams)
        );
    }

    private static function extractFilters(array $queryParams): array
    {
        $excludeKeys = ['page', 'limit', 'sortBy', 'sortOrder'];
        $filters = [];

        foreach ($queryParams as $key => $value) {
            if (!in_array($key, $excludeKeys) && !empty($value)) {
                $filters[$key] = $value;
            }
        }

        return $filters;
    }
}
