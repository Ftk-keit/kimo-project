<?php
namespace App\Services;

use App\Dto\Requests\VisitDto;
use App\Dto\Responses\VisitAllResponse;


interface VisitService 
{
    public function isVisit(int $id): bool;
    public function getVisitByPropertyId(int $id): array;
    public function createVisit(VisitDto $visitDto): array;
    public function updateVisit(int $id, VisitDto $visitDto): array;
    public function deleteVisit(int $id): array;
    public function deleteVisitByPropertyId(int $id): array;
    public function getVisitByVisitId(int $id): array;
    public function getAllVisits(): array;
}