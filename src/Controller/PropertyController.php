<?php

namespace App\Controller;

use App\Dto\Requests\PropertyDto;
use App\Services\PropertyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/properties')]
final class PropertyController extends AbstractController
{
    public function __construct(private PropertyService $propertyService)
    {
        
    }

    #[Route('', name: 'create_property', methods: ['POST'])] //ok
    public function create(PropertyDto $propertyDto): JsonResponse
    {
        $response = $this->propertyService->createProperty($propertyDto);
        return $this->json($response, Response::HTTP_CREATED);
    }

    #[Route('/{id}', name: 'get_property_by_id', methods: ['GET'])] //
    public function get(int $id): JsonResponse
    {
        $property = $this->propertyService->getPropertyById($id);
        
        if (!$property) {
            return $this->json(['error' => 'Property not found'], Response::HTTP_NOT_FOUND);
        }
        
        return $this->json($property);
    }

     #[Route('/', name: 'get_property', methods: ['GET'])]// ok
    public function getAll(): JsonResponse
    {
        $properties = $this->propertyService->getAllProperties();
        
        if (!$properties) {
            return $this->json(['error' => 'Properties not found'], Response::HTTP_NOT_FOUND);
        }
        
        return $this->json($properties);
    }

    #[Route('/{id}', name: 'update_property', methods: ['PUT'])] //ok
    public function update(int $id, PropertyDto $propertyDto): JsonResponse
    {
        $response = $this->propertyService->updateProperty($id, $propertyDto);
        
        if (!$response) {
            throw new \Exception('Property not found', 404);
        }
        
        return $this->json($response);
    }

    #[Route('/{id}', name: 'delete_property', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $deleted = $this->propertyService->deleteProperty($id);
        
        if (!$deleted) {
            throw new \Exception('Property not found', 404);
        }
        
        return $this->json(['message' => 'Property deleted successfully'], Response::HTTP_OK);
    }
}
