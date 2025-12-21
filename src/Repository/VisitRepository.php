<?php

namespace App\Repository;

use App\Entity\Visit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Visit>
 */
class VisitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Visit::class);
    }

    //    /**
    //     * @return Visit[] Returns an array of Visit objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('v')
    //            ->andWhere('v.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('v.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    /**
     * Find all visits
     */
    public function findAll(): array
    {
        return $this->createQueryBuilder('v')
            ->orderBy('v.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

   
    public function findById(int $id): ?Visit
    {
        return $this->find($id);
    }

    public function findByClient(int $clientId): array
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.client = :client')
            ->setParameter('client', $clientId)
            ->orderBy('v.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    
    public function findByProperty(int $propertyId): array
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.property = :property')
            ->setParameter('property', $propertyId)
            ->orderBy('v.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findByStatus(string $status): array
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.status = :status')
            ->setParameter('status', $status)
            ->orderBy('v.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    
    public function save(Visit $visit): void
    {
        $this->getEntityManager()->persist($visit);
        $this->getEntityManager()->flush();
    }

    public function update(Visit $visit): void
    {
        $this->getEntityManager()->persist($visit);
        $this->getEntityManager()->flush();
    }

    public function delete(Visit $visit): void
    {
        $this->getEntityManager()->remove($visit);
        $this->getEntityManager()->flush();
    }

    public function deleteById(int $id): void
    {
        $visit = $this->find($id);
        if ($visit) {
            $this->delete($visit);
        }
    }

   
    public function deleteByPropertyId(int $propertyId): void
    {
        $visits = $this->findByProperty($propertyId);
        foreach ($visits as $visit) {
            $this->delete($visit);
        }
    }
}

