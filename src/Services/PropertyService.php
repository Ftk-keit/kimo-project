<?php

namespace App\Services;

use App\Dto\Requests\PropertyDto;
use App\Dto\Responses\PropertyAllResponse;

interface PropertyService 
{
    public function createProperty(PropertyDto $createProperty): array;
    public function getPropertyById(int $id): array;
    public function getByTitle(string $title): array;
    public function getAllProperties(): array;
    public function updateProperty(int $id, PropertyDto $updateProperty): array;
    public function deleteProperty(int $id): array;
}