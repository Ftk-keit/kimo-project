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
        return $this->json($response, Response::HTTP_CREATED);
    }

    #[Route('/{id}', name: 'get_visit', methods: ['GET'])]
    public function get(int $id): JsonResponse
    {
        $visits = $this->visitService->getVisitByVisitId($id);
        
        if (empty($visits)) {
            throw new \Exception('Visit not found', 404);
        }
        
        return $this->json($visits[0]);
    }
    #[Route('/', name: 'get_all_visits', methods: ['GET'])]
    public function getAll(): JsonResponse
    {
        $visits = $this->visitService->getAllVisits();
        
        if (empty($visits)) {
            throw new \Exception('Visit not found', 404);
        }
        
        return $this->json($visits);
    }

    #[Route('/{id}', name: 'update_visit', methods: ['PUT'])]
    public function update(int $id, VisitDto $visitDto): JsonResponse
    {
        $response = $this->visitService->updateVisit($id, $visitDto);
        return $this->json($response);
    }

    #[Route('/{id}', name: 'delete_visit', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $this->visitService->deleteVisit($id);
        return $this->json(['message' => 'Visit deleted successfully'], Response::HTTP_OK);
    }

    #[Route('/property/{id}', name: 'get_visits_by_property', methods: ['GET'])]
    public function getByProperty(int $id): JsonResponse
    {
        $visits = $this->visitService->getVisitByPropertyId($id);
        return $this->json($visits);
    }
}
