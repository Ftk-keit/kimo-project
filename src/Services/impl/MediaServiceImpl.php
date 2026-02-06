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
        private MediaMapper $mediaMapper,
    ) {

    }

    public function createMedia(MediaDto $mediaDto): array
    {
        $response = [];
        $property = $this->propertyRepository->find($mediaDto->getPropertyId());
        if (!$property) {
            $response['message'] = 'Property not found';
            return $response;
        }
        $media = $this->mediaMapper->toEntity($mediaDto);
        $media->setProperty($property);
        $this->mediaRepository->save($media);
        $response['message'] = 'Media created successfull';
        $response['content'] = $this->mediaMapper->toDto($media);
        return $response;
    }

    public function getMediaById(int $id): array
    {
        $response = [];
        $media = $this->mediaRepository->find($id);
        if (!$media) {
            $response['message'] = 'Media not found';
            return $response;
        }
        $response['message'] = 'Media found successfully';
        $response['content'] = $this->mediaMapper->toDto($media);
        return $response;
    }

    public function updateMedia(int $id, MediaDto $mediaDto): array
    {
        $response = [];
        $media = $this->mediaRepository->find($id);
        $property = $this->propertyRepository->find($mediaDto->getPropertyId());
        if (!$media || !$property) {
            $response['message'] = 'Media or property not found';
            return $response;
        }

        $media->setUrl($mediaDto->getUrl());
        $media->setProperty($property);
        $this->mediaRepository->save($media);

        $response['message'] = 'Media updated successfully';
        $response['content'] = $this->mediaMapper->toDto($media);
        return $response;
    }

    public function deleteMedia(int $id): array
    {
        $response = [];
        $media = $this->mediaRepository->find($id);
        if (!$media) {
            $response['message'] = 'Media not found';
            return $response;
        }
        $response['content'] = $this->mediaMapper->toDto($media);  
        $this->mediaRepository->delete($media);
          $response['message'] = 'Media deleted successfully';
        return $response;
    }

    public function getAllMedia(): array
    {
        $response = [];
        $medias = $this->mediaRepository->findAll();
        if (!$medias) {
            $response['message'] = 'No media found';
            return $response;
        }
        $response['message'] = 'Media found successfully';
        $response['content'] = array_map(fn($media) => $this->mediaMapper->toDto($media), $medias);
        return $response;
    }

    public function getMediaByPropertyId(int $propertyId): array
    {
        $response = [];
        $medias = $this->mediaRepository->findByPropertyId($propertyId);
        if (!$medias) {
            $response['message'] = 'No media found for this property';
            return $response;
        }
        $response['message'] = 'Media found successfully for this property';
        $response['content'] = array_map(fn($media) => $this->mediaMapper->toDto($media), $medias);
        return $response;
    }
}
