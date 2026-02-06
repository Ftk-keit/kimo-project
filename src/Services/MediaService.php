<?php

namespace App\Services;

use App\Dto\Requests\MediaDto;
use App\Dto\Responses\MediaAllResponse;

interface MediaService
{
    public function createMedia(MediaDto $mediaDto): array;
    
    public function getMediaById(int $id): array;
    
    public function updateMedia(int $id, MediaDto $mediaDto): array;
    
    public function deleteMedia(int $id): array;
    
    public function getAllMedia(): array;
    
    public function getMediaByPropertyId(int $propertyId): array;
}
