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
    public function create(MediaDto $mediaDto, int $propertyId): JsonResponse
    {
        $media = $this->mediaService->createMedia($mediaDto, $propertyId);
        return $this->json($media, Response::HTTP_CREATED);
    }

    #[Route('/{id}', methods: ['GET'])]
    public function getOne(int $id): JsonResponse
    {
        $media = $this->mediaService->getMediaById($id);
        return $this->json($media);
    }

    #[Route('', methods: ['GET'])]
    public function getAll(): JsonResponse
    {
        $medias = $this->mediaService->getAllMedia();
        return $this->json($medias);
    }

    #[Route('/property/{propertyId}', methods: ['GET'])]
    public function getByProperty(int $propertyId): JsonResponse
    {
        $medias = $this->mediaService->getMediaByPropertyId($propertyId);
        return $this->json($medias);
    }

    #[Route('/{id}', methods: ['PUT'])]
    public function update(int $id, MediaDto $mediaDto): JsonResponse
    {
        $media = $this->mediaService->updateMedia($id, $mediaDto);
        return $this->json($media);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $this->mediaService->deleteMedia($id);
        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}
