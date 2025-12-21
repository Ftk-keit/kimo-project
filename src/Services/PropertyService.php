<?php

namespace App\Services;

use App\Dto\Requests\PropertyDto;
use App\Dto\Responses\PropertyAllResponse;

interface PropertyService 
{
    public function createProperty(PropertyDto $createProperty): ?PropertyAllResponse;
    public function getPropertyById(int $id): ?PropertyAllResponse;
    public function getByTitle(string $title): ?PropertyAllResponse;
    public function getAllProperties(): array;
    public function updateProperty(int $id, PropertyDto $updateProperty): ?PropertyAllResponse;
    public function deleteProperty(int $id): bool;
}