<?php


namespace App\Utils\Mappers;

use App\Dto\Requests\PropertyDto;
use App\Dto\Responses\PropertyAllResponse;
use App\Entity\Media;
use App\Entity\Property;
use App\Enums\StatusProperty;
use App\Enums\TypeProperty;
use App\Enums\TypeTransaction;

class PropertyMapper
{
    private TypeProperty $typeProperty;
    public static function toDto(Property $property): PropertyAllResponse
    {
        $dto = new PropertyAllResponse();
        $dto->setId($property->getId());
        $dto->setTitle($property->getTitle());
        $type = $property->getType();
        $dto->setType($type->value);
        $dto->setViews($property->getViews());
        $dto->setDescription($property->getDescription());
        $dto->setLocation($property->getLocation());
        $dto->setPrice($property->getPrice());
        $dto->setLocation($property->getLocation());
        $dto->setCity($property->getCity());
        $status = $property->getStatus();
        $dto->setStatus($status->value);
        $dto->setBedrooms($property->getBedroom());
        $dto->setBathrooms($property->getBathroom());
        $dto->setOwnerId($property->getOwner()->getId());
        $dto->setSurface($property->getSurface());
        $dto->setCharacteristic($property->getCharacteristic());
        $mediaUrls = [];
        foreach ($property->getMedia() as $media) {
            $mediaUrls[] = $media->getUrl();
        }
        $dto->setMedia($mediaUrls);
        
        return $dto;
    }

    public static function toEntity(PropertyDto $dto): Property
    {
        $type = TypeProperty::toEnum($dto->getType());
        $status = StatusProperty::toEnum($dto->getStatus());
        $typeTransaction = TypeTransaction::toEnum($dto->getTypeTransaction());
        $property = new Property();
        $property->setTitle($dto->getTitle());
        $property->setPrice($dto->getPrice());
        $property->setType($type);
        $property->setViews($dto->getViews());
        $property->setStatus($status);
        $property->setDescription($dto->getDescription());
        $property->setLocation($dto->getLocation());
        $property->setCity($dto->getCity());
        $property->setBedroom($dto->getBedrooms());
        $property->setBathroom($dto->getBathrooms());
        $property->setSurface($dto->getSurface());
        $property->setCharacteristic($dto->getCharacteristic());
        $property->setTypeTransaction($typeTransaction);
        foreach ($dto->getMedia() as $mediaUrl) {
            $media = new Media();
            $media->setUrl($mediaUrl);
            $property->addMedia($media);
        }
        return $property;
    }
}