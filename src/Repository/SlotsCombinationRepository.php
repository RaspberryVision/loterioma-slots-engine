<?php

namespace App\Repository;

use App\Entity\SlotsCombination;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SlotsCombination|null find($id, $lockMode = null, $lockVersion = null)
 * @method SlotsCombination|null findOneBy(array $criteria, array $orderBy = null)
 * @method SlotsCombination[]    findAll()
 * @method SlotsCombination[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SlotsCombinationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SlotsCombination::class);
    }

    // /**
    //  * @return SlotsCombination[] Returns an array of SlotsCombination objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SlotsCombination
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
