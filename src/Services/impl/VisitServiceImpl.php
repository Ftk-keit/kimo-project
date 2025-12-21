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
        $visits = $this->visitRepository->findByProperty($id);
        
        $visitResponses = [];
        foreach ($visits as $visit) {
            $visitResponses[] = $this->visitMapper->toDto($visit);
        }
        
        return $visitResponses;
    }

    public function createVisit(VisitDto $visitDto): ?VisitAllResponse
    {
        $visit = $this->visitMapper->toEntity($visitDto);
        
        $property = $this->propertyRepository->findById($visitDto->getPropertyId());
        $client = $this->userRepository->findById($visitDto->getClientId());
        if ($property === null || $client === null) {
           return null;
        }
        $visit->setProperty($property);
        $visit->setClient($client);

        $this->visitRepository->save($visit);
        
        return $this->visitMapper->toDto($visit);
    }

    public function updateVisit(int $id, VisitDto $visitDto): ?VisitAllResponse
    {
        $visit = $this->visitRepository->findById($id);
        
        if (!$visit) {
           return null;
        }
        
        $property = $this->propertyRepository->findById($visitDto->getPropertyId());
        $client = $this->userRepository->findById($visitDto->getClientId());
        if ($property === null || $client === null) {
           return null;
        }
        $visit->setProperty($property);
        $visit->setClient($client);
        $visit->setDate($visitDto->getDate());
        $visit->setStatus(StatusVisit::from($visitDto->getStatus()));
        
        $this->visitRepository->update($visit);
        
        return $this->visitMapper->toDto($visit);
    }

    public function deleteVisit(int $id): ?VisitAllResponse
    {
        $visit = $this->visitRepository->findById($id);
        
        if (!$visit) {
            return null;
        }
        $this->visitRepository->delete($visit);
        return $this->visitMapper->toDto($visit);
    }

    public function deleteVisitByPropertyId(int $id): ?VisitAllResponse
    {
        $this->visitRepository->deleteByPropertyId($id);
    }

    public function getVisitByVisitId(int $id): ?array
    {
        $visit = $this->visitRepository->findById($id);
        
        if (!$visit) {
            return [];
        }
        
        return [$this->visitMapper->toDto($visit)];
    }

    public function getAllVisits(): array
    {
        // Récupérer toutes les visites
        $visits = $this->visitRepository->findAll();
        
        // Convertir chaque visite en DTO
        $visitResponses = [];
        foreach ($visits as $visit) {
            $visitResponses[] = $this->visitMapper->toDto($visit);
        }
        
        return $visitResponses;
    }
}
