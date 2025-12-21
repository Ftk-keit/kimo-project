<?php

namespace App\Services\impl;

use App\Dto\Requests\MediaDto;
use App\Dto\Responses\MediaAllResponse;
use App\Entity\Media;
use App\Repository\MediaRepository;
use App\Repository\PropertyRepository;
use App\Services\MediaService;
use App\Utils\Mappers\MediaMapper;

class MediaServiceImpl implements MediaService
{
    public function __construct(
        private MediaRepository $mediaRepository,
        private PropertyRepository $propertyRepository,
        private MediaMapper $mediaMapper
    ) {}

    public function createMedia(MediaDto $mediaDto, int $propertyId): MediaAllResponse
    {
        $property = $this->propertyRepository->find($propertyId);
        if (!$property) {
            throw new \Exception("Property not found");
        }

        $media = $this->mediaMapper->toEntity($mediaDto);
        $media->setProperty($property);
        
        $this->mediaRepository->save($media);

        return $this->mediaMapper->toDto($media);
    }

    public function getMediaById(int $id): MediaAllResponse
    {
        $media = $this->mediaRepository->find($id);
        if (!$media) {
            throw new \Exception("Media not found");
        }

        return $this->mediaMapper->toDto($media);
    }

    public function updateMedia(int $id, MediaDto $mediaDto): MediaAllResponse
    {
        $media = $this->mediaRepository->find($id);
        if (!$media) {
            throw new \Exception("Media not found");
        }

        $media->setUrl($mediaDto->getUrl());
        $this->mediaRepository->save($media);

        return $this->mediaMapper->toDto($media);
    }

    public function deleteMedia(int $id): void
    {
        $media = $this->mediaRepository->find($id);
        if (!$media) {
            throw new \Exception("Media not found");
        }

        $this->mediaRepository->delete($media);
    }

    public function getAllMedia(): array
    {
        $medias = $this->mediaRepository->findAll();
        return array_map(fn($media) => $this->mediaMapper->toDto($media), $medias);
    }

    public function getMediaByPropertyId(int $propertyId): array
    {
        $medias = $this->mediaRepository->findByPropertyId($propertyId);
        return array_map(fn($media) => $this->mediaMapper->toDto($media), $medias);
    }
}
