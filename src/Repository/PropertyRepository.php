<?php

namespace App\Repository;

use App\Dto\Responses\PropertyAllResponse;
use App\Entity\Property;
use App\Utils\Mappers\PropertyMapper;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Property>
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Property::class);
    }

//    /**
//     * @return Property[] Returns an array of Property objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

   public function findbyId($value): ?Property
   {
    return $this->createQueryBuilder('p')
           ->leftJoin('p.media', 'm')
           ->addSelect('m')
           ->andWhere('p.id = :val')
           ->setParameter('val', $value)
           ->getQuery()
           ->getOneOrNullResult()
    ;
   }
   
   public function findAll(): array
   {
    return $this->createQueryBuilder('p')
           ->leftJoin('p.media', 'm')
           ->addSelect('m')
           ->orderBy('p.id','ASC')
           ->getQuery()
           ->getResult()
    ;
   }

   
   public function findByOwner(int $ownerId): array
   {
       return $this->createQueryBuilder('p')
           ->leftJoin('p.media', 'm')
           ->addSelect('m')
           ->andWhere('p.owner = :owner')
           ->setParameter('owner', $ownerId)
           ->orderBy('p.id', 'ASC')
           ->getQuery()
           ->getResult();
   }

   public function findByCity(string $city): array
   {
       return $this->createQueryBuilder('p')
           ->leftJoin('p.media', 'm')
           ->addSelect('m')
           ->andWhere('p.city = :city')
           ->setParameter('city', $city)
           ->orderBy('p.id', 'ASC')
           ->getQuery()
           ->getResult();
   }
   public function findByTitle(string $title): ?Property
   {
       return $this->createQueryBuilder('p')
           ->leftJoin('p.media', 'm')
           ->addSelect('m')
           ->andWhere('p.title = :title')
           ->setParameter('title', $title)
           ->getQuery()
           ->getOneOrNullResult();
   }
   

   public function findByStatus(string $status): array
   {
       return $this->createQueryBuilder('p')
           ->leftJoin('p.media', 'm')
           ->addSelect('m')
           ->andWhere('p.status = :status')
           ->setParameter('status', $status)
           ->orderBy('p.id', 'ASC')
           ->getQuery()
           ->getResult();
   }

 
   public function findByPriceRange(string $minPrice, string $maxPrice): array
   {
       return $this->createQueryBuilder('p')
           ->leftJoin('p.media', 'm')
           ->addSelect('m')
           ->andWhere('p.price >= :minPrice')
           ->andWhere('p.price <= :maxPrice')
           ->setParameter('minPrice', $minPrice)
           ->setParameter('maxPrice', $maxPrice)
           ->orderBy('p.price', 'ASC')
           ->getQuery()
           ->getResult();
   }

   
   public function save(Property $property): void
   {
       $this->getEntityManager()->persist($property);
       $this->getEntityManager()->flush();
   }

   
   public function update(Property $property): void
   {
       $this->getEntityManager()->persist($property);
       $this->getEntityManager()->flush();
   }

  
   public function delete(Property $property): void
   {
       $this->getEntityManager()->remove($property);
       $this->getEntityManager()->flush();
   }


   public function deleteById(int $id): void
   {
       $property = $this->find($id);
       if ($property) {
           $this->delete($property);
       }
   }
}
