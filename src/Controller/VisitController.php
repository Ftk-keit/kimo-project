<?php

namespace App\Controller;

use App\Dto\Requests\VisitDto;
use App\Services\VisitService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/visits')]
final class VisitController extends AbstractController
{
    public function __construct(private VisitService $visitService)
    {
    }

    #[Route('', name: 'create_visit', methods: ['POST'])]
    public function create(VisitDto $visitDto): JsonResponse
    {
        $response = $this->visitService->createVisit($visitDto);
        if (!isset($response['content'])) {
            return $this->json($response['message'], Response::HTTP_BAD_REQUEST);
        }
        return $this->json($response['content'], Response::HTTP_CREATED);
    }

    #[Route('/{id}', name: 'get_visit', methods: ['GET'])]
    public function get(int $id): JsonResponse
    {
        $response = $this->visitService->getVisitByVisitId($id);
        if (!isset($response['content'])) {
            return $this->json($response['message'], Response::HTTP_NOT_FOUND);
        }
        return $this->json($response['content'][0], Response::HTTP_OK);
    }

    #[Route('/', name: 'get_all_visits', methods: ['GET'])]
    public function getAll(): JsonResponse
    {
        $response = $this->visitService->getAllVisits();
        if (!isset($response['content'])) {
            return $this->json($response['message'], Response::HTTP_NOT_FOUND);
        }
        return $this->json($response['content'], Response::HTTP_OK);
    }

    #[Route('/{id}', name: 'update_visit', methods: ['PUT'])]
    public function update(int $id, VisitDto $visitDto): JsonResponse
    {
        $response = $this->visitService->updateVisit($id, $visitDto);
        if (!isset($response['content'])) {
            return $this->json($response['message'], Response::HTTP_BAD_REQUEST);
        }
        return $this->json($response['content'], Response::HTTP_OK);
    }

    #[Route('/{id}', name: 'delete_visit', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $response = $this->visitService->deleteVisit($id);
        if (!isset($response['content'])) {
            return $this->json($response['message'], Response::HTTP_NOT_FOUND);
        }
        return $this->json($response['content'], Response::HTTP_OK);
    }

    #[Route('/property/{id}', name: 'get_visits_by_property', methods: ['GET'])]
    public function getByProperty(int $id): JsonResponse
    {
        $response = $this->visitService->getVisitByPropertyId($id);
        if (!isset($response['content'])) {
            return $this->json($response['message'], Response::HTTP_NOT_FOUND);
        }
        return $this->json($response['content'], Response::HTTP_OK);
    }
}
