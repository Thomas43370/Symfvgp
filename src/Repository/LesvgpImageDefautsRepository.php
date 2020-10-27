<?php

namespace App\Repository;

use App\Entity\LesvgpImageDefauts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LesvgpImageDefauts|null find($id, $lockMode = null, $lockVersion = null)
 * @method LesvgpImageDefauts|null findOneBy(array $criteria, array $orderBy = null)
 * @method LesvgpImageDefauts[]    findAll()
 * @method LesvgpImageDefauts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LesvgpImageDefautsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LesvgpImageDefauts::class);
    }

    // /**
    //  * @return LesvgpImageDefauts[] Returns an array of LesvgpImageDefauts objects
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
    public function findOneBySomeField($value): ?LesvgpImageDefauts
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
