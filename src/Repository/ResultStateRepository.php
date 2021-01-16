<?php

namespace App\Repository;

use App\Entity\ResultState;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ResultState|null find($id, $lockMode = null, $lockVersion = null)
 * @method ResultState|null findOneBy(array $criteria, array $orderBy = null)
 * @method ResultState[]    findAll()
 * @method ResultState[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResultStateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ResultState::class);
    }

    // /**
    //  * @return ResultState[] Returns an array of ResultState objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ResultState
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
