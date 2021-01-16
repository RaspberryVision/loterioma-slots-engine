<?php

namespace App\Repository;

use App\Entity\GeneratorConfig;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GeneratorConfig|null find($id, $lockMode = null, $lockVersion = null)
 * @method GeneratorConfig|null findOneBy(array $criteria, array $orderBy = null)
 * @method GeneratorConfig[]    findAll()
 * @method GeneratorConfig[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GeneratorConfigRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GeneratorConfig::class);
    }

    // /**
    //  * @return GeneratorConfig[] Returns an array of GeneratorConfig objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GeneratorConfig
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
