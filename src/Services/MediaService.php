<?php

namespace App\Services;

use App\Dto\Requests\MediaDto;
use App\Dto\Responses\MediaAllResponse;

interface MediaService
{
    public function createMedia(MediaDto $mediaDto, int $propertyId): MediaAllResponse;
    
    public function getMediaById(int $id): MediaAllResponse;
    
    public function updateMedia(int $id, MediaDto $mediaDto): MediaAllResponse;
    
    public function deleteMedia(int $id): void;
    
    public function getAllMedia(): array;
    
    public function getMediaByPropertyId(int $propertyId): array;
}
