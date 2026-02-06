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

    #[Route('', name: 'create_property', methods: ['POST'])]
    public function create(PropertyDto $propertyDto): JsonResponse
    {
        $response = $this->propertyService->createProperty($propertyDto);
        if (!isset($response['content'])) {
            return $this->json($response['message'], Response::HTTP_BAD_REQUEST);
        }
        return $this->json($response['content'], Response::HTTP_CREATED);
    }

    #[Route('/{id}', name: 'get_property_by_id', methods: ['GET'])]
    public function get(int $id): JsonResponse
    {
        $response = $this->propertyService->getPropertyById($id);
        if (!isset($response['content'])) {
            return $this->json($response['message'], Response::HTTP_NOT_FOUND);
        }
        return $this->json($response['content'], Response::HTTP_OK);
    }

    #[Route('/', name: 'get_property', methods: ['GET'])]
    public function getAll(): JsonResponse
    {
        $response = $this->propertyService->getAllProperties();
        if (!isset($response['content'])) {
            return $this->json($response['message'], Response::HTTP_NOT_FOUND);
        }
        return $this->json($response['content'], Response::HTTP_OK);
    }

    #[Route('/{id}', name: 'update_property', methods: ['PUT'])]
    public function update(int $id, PropertyDto $propertyDto): JsonResponse
    {
        $response = $this->propertyService->updateProperty($id, $propertyDto);
        if (!isset($response['content'])) {
            return $this->json($response['message'], Response::HTTP_BAD_REQUEST);
        }
        return $this->json($response['content'], Response::HTTP_OK);
    }

    #[Route('/{id}', name: 'delete_property', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $response = $this->propertyService->deleteProperty($id);
        if (!isset($response['content'])) {
            return $this->json($response['message'], Response::HTTP_NOT_FOUND);
        }
        return $this->json($response['content'], Response::HTTP_OK);
    }
}
