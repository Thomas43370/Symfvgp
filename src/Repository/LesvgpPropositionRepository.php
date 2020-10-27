<?php

namespace App\Repository;

use App\Entity\LesvgpProposition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LesvgpProposition|null find($id, $lockMode = null, $lockVersion = null)
 * @method LesvgpProposition|null findOneBy(array $criteria, array $orderBy = null)
 * @method LesvgpProposition[]    findAll()
 * @method LesvgpProposition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LesvgpPropositionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LesvgpProposition::class);
    }

    // /**
    //  * @return LesvgpProposition[] Returns an array of LesvgpProposition objects
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
    public function findOneBySomeField($value): ?LesvgpProposition
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
