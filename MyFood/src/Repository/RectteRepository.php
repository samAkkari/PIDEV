<?php

namespace App\Repository;

use App\Entity\Rectte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Rectte|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rectte|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rectte[]    findAll()
 * @method Rectte[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RectteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rectte::class);
    }

    // /**
    //  * @return Rectte[] Returns an array of Rectte objects
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
    public function findOneBySomeField($value): ?Rectte
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
