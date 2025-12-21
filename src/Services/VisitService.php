<?php
namespace App\Services;

use App\Dto\Requests\VisitDto;
use App\Dto\Responses\VisitAllResponse;


interface VisitService 
{
    public function isVisit(int $id): bool;
    public function getVisitByPropertyId(int $id): ?array;
    public function createVisit(VisitDto $visitDto): VisitAllResponse;
    public function updateVisit(int $id, VisitDto $visitDto): VisitAllResponse;
    public function deleteVisit(int $id): ?VisitAllResponse;
    public function deleteVisitByPropertyId(int $id): ?VisitAllResponse;
    public function getVisitByVisitId(int $id): ?array;
    public function getAllVisits(): array;
}