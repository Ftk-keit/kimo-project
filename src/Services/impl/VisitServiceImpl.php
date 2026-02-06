<?php

namespace App\Services\impl;

use App\Dto\Requests\VisitDto;
use App\Dto\Responses\VisitAllResponse;
use App\Entity\Visit;
use App\Enums\StatusVisit;
use App\Repository\PropertyRepository;
use App\Repository\UserRepository;
use App\Repository\VisitRepository;
use App\Services\VisitService;
use App\Utils\Mappers\VisitMapper;

class VisitServiceImpl implements VisitService
{
    private VisitRepository $visitRepository;
    private VisitMapper $visitMapper;
    private PropertyRepository $propertyRepository;
    private UserRepository $userRepository;

    public function __construct(
        VisitRepository $visitRepository,
        VisitMapper $visitMapper,
        PropertyRepository $propertyRepository,
        UserRepository $userRepository
    ) {
        $this->visitRepository = $visitRepository;
        $this->visitMapper = $visitMapper;
        $this->propertyRepository = $propertyRepository;
        $this->userRepository = $userRepository;
    }

    public function isVisit(int $id): bool
    {
        $visit = $this->visitRepository->findById($id);
        return $visit !== null;
    }

    public function getVisitByPropertyId(int $id): array
    {
        $response = [];
        $visits = $this->visitRepository->findByProperty($id);
        
        if (!$visits) {
            $response['message'] = 'No visits found for this property';
            return $response;
        }
        
        $response['message'] = 'Visits found successfully for this property';
        $response['content'] = array_map(fn($visit) => $this->visitMapper->toDto($visit), $visits);
        return $response;
    }

    public function createVisit(VisitDto $visitDto): array
    {
        $response = [];
        $visit = $this->visitMapper->toEntity($visitDto);
        
        $property = $this->propertyRepository->findById($visitDto->getPropertyId());
        $client = $this->userRepository->findById($visitDto->getClientId());
        if ($property === null || $client === null) {
            $response['message'] = 'Property or client not found';
            return $response;
        }
        $visit->setProperty($property);
        $visit->setClient($client);

        $this->visitRepository->save($visit);
        
        $response['message'] = 'Visit created successfully';
        $response['content'] = $this->visitMapper->toDto($visit);
        return $response;
    }

    public function updateVisit(int $id, VisitDto $visitDto): array
    {
        $response = [];
        $visit = $this->visitRepository->findById($id);
        
        if (!$visit) {
            $response['message'] = 'Visit not found';
            return $response;
        }
        
        $property = $this->propertyRepository->findById($visitDto->getPropertyId());
        $client = $this->userRepository->findById($visitDto->getClientId());
        if ($property === null || $client === null) {
            $response['message'] = 'Property or client not found';
            return $response;
        }
        $visit->setProperty($property);
        $visit->setClient($client);
        $visit->setDate($visitDto->getDate());
        $visit->setStatus(StatusVisit::from($visitDto->getStatus()));
        
        $this->visitRepository->update($visit);
        
        $response['message'] = 'Visit updated successfully';
        $response['content'] = $this->visitMapper->toDto($visit);
        return $response;
    }

    public function deleteVisit(int $id): array
    {
        $response = [];
        $visit = $this->visitRepository->findById($id);
        
        if (!$visit) {
            $response['message'] = 'Visit not found';
            return $response;
        }
        $response['content'] = $this->visitMapper->toDto($visit);
        $this->visitRepository->delete($visit);
        $response['message'] = 'Visit deleted successfully';
        return $response;
    }

    public function deleteVisitByPropertyId(int $id): array
    {
        $response = [];
        $this->visitRepository->deleteByPropertyId($id);
        $response['message'] = 'Visits deleted successfully';
        return $response;
    }

    public function getVisitByVisitId(int $id): array
    {
        $response = [];
        $visit = $this->visitRepository->findById($id);
        
        if (!$visit) {
            $response['message'] = 'Visit not found';
            return $response;
        }
        
        $response['message'] = 'Visit found successfully';
        $response['content'] = [$this->visitMapper->toDto($visit)];
        return $response;
    }

    public function getAllVisits(): array
    {
        $response = [];
        // Récupérer toutes les visites
        $visits = $this->visitRepository->findAll();
        
        if (!$visits) {
            $response['message'] = 'No visits found';
            return $response;
        }
        
        // Convertir chaque visite en DTO
        $response['message'] = 'Visits found successfully';
        $response['content'] = array_map(fn($visit) => $this->visitMapper->toDto($visit), $visits);
        
        return $response;
    }
}
