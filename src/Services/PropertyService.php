<?php

namespace App\Services;

interface PropertyService 
{
    public function createProperty(PropertyDto $createProperty): PropertyAllResponse;
    public function getPropertyById(int $id): ?PropertyAllResponse;

    public function updateProperty(int $id, PropertyDto $updateProperty): ?PropertyAllResponse;
    public function deleteProperty(int $id): bool;
}