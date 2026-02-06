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

    public function createProperty(PropertyDto $createProperty): array
    {
        $response = [];
        $owner = $this->userRepository->findById($createProperty->getOwnerId());
        if (!$owner) {
            $response['message'] = 'Owner not found';
            return $response;
        }
        $property = $this->propertyMapper->toEntity($createProperty);
        $property->setOwner($owner);
        $this->propertyRepository->save($property);
        
        $response['message'] = 'Property created successfully';
        $response['content'] = $this->propertyMapper->toDto($property);
        return $response;
    }

    public function getPropertyById(int $id): array
    {
        $response = [];
        $property = $this->propertyRepository->findById($id);
        
        if (!$property) {
            $response['message'] = 'Property not found';
            return $response;
        }

        $response['message'] = 'Property found successfully';
        $response['content'] = $this->propertyMapper->toDto($property);
        return $response;
    }

    public function getByTitle(string $title): array
    {
        $response = [];
        $property = $this->propertyRepository->findByTitle($title);
        
        if (!$property) {
            $response['message'] = 'Property not found';
            return $response;
        }

        $response['message'] = 'Property found successfully';
        $response['content'] = $this->propertyMapper->toDto($property);
        return $response;
    }

    public function getAllProperties(): array
    {
        $response = [];
        $properties = $this->propertyRepository->findAll();
        if (!$properties) {
            $response['message'] = 'No properties found';
            return $response;
        }
        
        $response['message'] = 'Properties found successfully';
        $response['content'] = array_map(fn($property) => $this->propertyMapper->toDto($property), $properties);
        return $response;
    }

    public function updateProperty(int $id, PropertyDto $updateProperty): array
    {
        $response = [];
        $property = $this->propertyRepository->findById($id);
        
        if (!$property) {
            $response['message'] = 'Property not found';
            return $response;
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
        
        $response['message'] = 'Property updated successfully';
        $response['content'] = $this->propertyMapper->toDto($property);
        return $response;
    }

    public function deleteProperty(int $id): array
    {
        $response = [];
        $property = $this->propertyRepository->findById($id);
        
        if (!$property) {
            $response['message'] = 'Property not found';
            return $response;
        }
        
        $response['content'] = $this->propertyMapper->toDto($property);
        $this->propertyRepository->deleteById($id);
        $response['message'] = 'Property deleted successfully';
        
        return $response;
    }
}
