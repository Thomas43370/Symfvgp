<?php

namespace App\Repository;

use App\Entity\LesvgpVgp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LesvgpVgp|null find($id, $lockMode = null, $lockVersion = null)
 * @method LesvgpVgp|null findOneBy(array $criteria, array $orderBy = null)
 * @method LesvgpVgp[]    findAll()
 * @method LesvgpVgp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LesvgpVgpRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LesvgpVgp::class);
    }

    // /**
    //  * @return LesvgpVgp[] Returns an array of LesvgpVgp objects
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
    public function findOneBySomeField($value): ?LesvgpVgp
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
