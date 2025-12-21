<?php

namespace App\Utils\Mappers;

use App\Dto\Requests\VisitDto;
use App\Dto\Responses\VisitAllResponse;
use App\Entity\Visit;
use App\Enums\StatusVisit;

class VisitMapper
{
    public static function toDto(Visit $visit): VisitAllResponse
    {
        $dto = new VisitAllResponse();

        $dto->setId($visit->getId());
        $dto->setVisitDate($visit->getDate());
        $dto->setHourse($visit->getHourse()->format('Y-m-d H:i:s'));
        $dto->setStatus($visit->getStatus()->value);
        $dto->setClientId($visit->getClient()->getId());
        $dto->setPropertyId($visit->getProperty()->getId());

        return $dto;
    }

    public static function toEntity(VisitDto $dto): Visit
    {
        $visit = new Visit();
        $status = StatusVisit::toEnum($dto->getStatus());
        $visit->setDate($dto->getVisitDate());
        $visit->setHourse($dto->getHourse());
        $visit->setStatus($status);

        return $visit;
    }
}
