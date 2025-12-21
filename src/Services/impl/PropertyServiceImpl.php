<?php

namespace App\Services\impl;

use App\Dto\Requests\PropertyDto;
use App\Dto\Responses\PropertyAllResponse;
use App\Entity\Property;
use App\Repository\PropertyRepository;
use App\Repository\UserRepository;
use App\Services\PropertyService;
use App\Utils\Mappers\PropertyMapper;

class PropertyServiceImpl implements PropertyService
{
    private PropertyRepository $propertyRepository;
    private PropertyMapper $propertyMapper;
    private UserRepository $userRepository;
    public function __construct(PropertyRepository $propertyRepository, PropertyMapper $propertyMapper, UserRepository $userRepository)
    {
        $this->propertyRepository = $propertyRepository;
        $this->propertyMapper = $propertyMapper;
        $this->userRepository = $userRepository;
    }

    public function createProperty(PropertyDto $createProperty): ?PropertyAllResponse
    {
        $property = $this->propertyMapper->toEntity($createProperty);
        $owner = $this->userRepository->findById($createProperty->getOwnerId());
        if (!$owner) {
          return null;
        }
        $property->setOwner($owner);
        $this->propertyRepository->save($property);
        
        return $this->propertyMapper->toDto($property);
    }

    public function getPropertyById(int $id): ?PropertyAllResponse
    {
        $property = $this->propertyRepository->findById($id);
        
        if (!$property) {
            return null;
        }

        return $this->propertyMapper->toDto($property);
    }
        public function getByTitle(string $title): ?PropertyAllResponse
        {
            $property = $this->propertyRepository->findByTitle($title);
            
            if (!$property) {
                return null;
            }

            return $this->propertyMapper->toDto($property);
        }
 public function getAllProperties(): array
    {
        $properties = $this->propertyRepository->findAll();
        $propertyDtos = [];
        
        foreach ($properties as $property) {
            $propertyDtos[] = $this->propertyMapper->toDto($property);
        }
        
        return $propertyDtos;
    }   
   

    public function updateProperty(int $id, PropertyDto $updateProperty): ?PropertyAllResponse
    {
        $property = $this->propertyRepository->findById($id);
        
        if (!$property) {
            return null;
        }
        
        $property->setTitle($updateProperty->getTitle());
        $property->setViews($updateProperty->getViews());
        $property->setDescription($updateProperty->getDescription());
        $property->setLocation($updateProperty->getLocation());
        $property->setPrice($updateProperty->getPrice());
        $property->setSurface($updateProperty->getSurface());
        $property->setCity($updateProperty->getCity());
        $property->setBedroom($updateProperty->getBedrooms());
        $property->setBathroom($updateProperty->getBathrooms());
        
        $this->propertyRepository->update($property);
        
        return $this->propertyMapper->toDto($property);
    }

    public function deleteProperty(int $id): bool
    {
        $property = $this->propertyRepository->findById($id);
        
        if (!$property) {
            return false;
        }
        $this->propertyRepository->deleteById($id);
        
        return true;
    }
}
