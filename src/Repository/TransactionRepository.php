<?php

namespace App\Repository;

use App\Entity\Transaction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Transaction>
 */
class TransactionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Transaction::class);
    }

//    /**
//     * @return Transaction[] Returns an array of Transaction objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

    
    public function findAll(): array
    {
        return $this->createQueryBuilder('t')
            ->orderBy('t.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findById(int $id): ?Transaction
    {
        return $this->find($id);
    }

  
    public function findBySeller(int $sellerId): array
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.seller = :seller')
            ->setParameter('seller', $sellerId)
            ->orderBy('t.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

   
    public function findByBuyer(int $buyerId): array
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.buyer = :buyer')
            ->setParameter('buyer', $buyerId)
            ->orderBy('t.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

   
    public function findByProperty(int $propertyId): array
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.property = :property')
            ->setParameter('property', $propertyId)
            ->orderBy('t.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    
    public function findByStatus(string $status): array
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.status = :status')
            ->setParameter('status', $status)
            ->orderBy('t.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

   
    public function save(Transaction $transaction): void
    {
        $this->getEntityManager()->persist($transaction);
        $this->getEntityManager()->flush();
    }

  
    public function update(Transaction $transaction): void
    {
        $this->getEntityManager()->persist($transaction);
        $this->getEntityManager()->flush();
    }

    public function delete(Transaction $transaction): void
    {
        $this->getEntityManager()->remove($transaction);
        $this->getEntityManager()->flush();
    }

    public function deleteById(int $id): void
    {
        $transaction = $this->find($id);
        if ($transaction) {
            $this->delete($transaction);
        }
    }
}

