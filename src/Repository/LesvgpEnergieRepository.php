<?php

namespace App\Repository;

use App\Entity\LesvgpEnergie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LesvgpEnergie|null find($id, $lockMode = null, $lockVersion = null)
 * @method LesvgpEnergie|null findOneBy(array $criteria, array $orderBy = null)
 * @method LesvgpEnergie[]    findAll()
 * @method LesvgpEnergie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LesvgpEnergieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LesvgpEnergie::class);
    }

    // /**
    //  * @return LesvgpEnergie[] Returns an array of LesvgpEnergie objects
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
    public function findOneBySomeField($value): ?LesvgpEnergie
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
