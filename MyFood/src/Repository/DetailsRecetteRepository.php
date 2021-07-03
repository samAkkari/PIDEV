<?php

namespace App\Repository;

use App\Entity\DetailsRecette;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DetailsRecette|null find($id, $lockMode = null, $lockVersion = null)
 * @method DetailsRecette|null findOneBy(array $criteria, array $orderBy = null)
 * @method DetailsRecette[]    findAll()
 * @method DetailsRecette[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetailsRecetteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DetailsRecette::class);
    }

    // /**
    //  * @return DetailsRecette[] Returns an array of DetailsRecette objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DetailsRecette
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
