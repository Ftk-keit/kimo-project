<?php

namespace App\Utils\Mappers;

use App\Dto\Requests\MediaDto;
use App\Dto\Responses\MediaAllResponse;
use App\Entity\Media;

class MediaMapper
{
    public function toDto(Media $media): MediaAllResponse
    {
        $mediaResponse = new MediaAllResponse();
        $mediaResponse->setId($media->getId());
        $mediaResponse->setUrl($media->getUrl());
        $mediaResponse->setPropertyId($media->getProperty()->getId());

        return $mediaResponse;
    }

    public function toEntity(MediaDto $mediaDto): Media
    {
        $media = new Media();
        $media->setUrl($mediaDto->getUrl());

        return $media;
    }
}
