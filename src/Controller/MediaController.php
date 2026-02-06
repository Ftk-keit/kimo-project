<?php

namespace App\Controller;

use App\Dto\Requests\MediaDto;
use App\Services\MediaService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/media')]
class MediaController extends AbstractController
{
    public function __construct(private MediaService $mediaService) {}

    #[Route('', methods: ['POST'])]
    public function create(MediaDto $mediaDto): JsonResponse
    {
        $response = $this->mediaService->createMedia($mediaDto);
        if (!isset($response['content'])) {
            return $this->json($response['message'], Response::HTTP_BAD_REQUEST);
        }
        return $this->json($response['content'], Response::HTTP_CREATED);
    }

    #[Route('/{id}', methods: ['GET'])]
    public function getOne(int $id): JsonResponse
    {
        $response = $this->mediaService->getMediaById($id);
        if (!isset($response['content'])) {
            return $this->json($response['message'], Response::HTTP_NOT_FOUND);
        }
        return $this->json($response['content'], Response::HTTP_OK);
    }

    #[Route('', methods: ['GET'])]
    public function getAll(): JsonResponse
    {
        $response = $this->mediaService->getAllMedia();
        if (!isset($response['content'])) {
            return $this->json($response['message'], Response::HTTP_NOT_FOUND);
        }
        return $this->json($response['content'], Response::HTTP_OK);
    }

    #[Route('/property/{propertyId}', methods: ['GET'])]
    public function getByProperty(int $propertyId): JsonResponse
    {
        $response = $this->mediaService->getMediaByPropertyId($propertyId);
        if (!isset($response['content'])) {
            return $this->json($response['message'], Response::HTTP_NOT_FOUND);
        }
        return $this->json($response['content'], Response::HTTP_OK);
    }

    #[Route('/{id}', methods: ['PUT'])]
    public function update(int $id, MediaDto $mediaDto): JsonResponse
    {
        $response = $this->mediaService->updateMedia($id, $mediaDto);
        if (!isset($response['content'])) {
            return $this->json($response['message'], Response::HTTP_BAD_REQUEST);
        }
        return $this->json($response['content'], Response::HTTP_OK);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $response = $this->mediaService->deleteMedia($id);
        if (!isset($response['content'])) {
            return $this->json($response['message'], Response::HTTP_NOT_FOUND);
        }
        return $this->json($response['content'], Response::HTTP_OK);
    }
}
