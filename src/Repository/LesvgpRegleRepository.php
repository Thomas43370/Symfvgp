<?php

namespace App\Repository;

use App\Entity\LesvgpRegle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LesvgpRegle|null find($id, $lockMode = null, $lockVersion = null)
 * @method LesvgpRegle|null findOneBy(array $criteria, array $orderBy = null)
 * @method LesvgpRegle[]    findAll()
 * @method LesvgpRegle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LesvgpRegleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LesvgpRegle::class);
    }

    // /**
    //  * @return LesvgpRegle[] Returns an array of LesvgpRegle objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LesvgpRegle
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
