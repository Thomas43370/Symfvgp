<?php

namespace App\Repository;

use App\Entity\LesvgpTitre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LesvgpTitre|null find($id, $lockMode = null, $lockVersion = null)
 * @method LesvgpTitre|null findOneBy(array $criteria, array $orderBy = null)
 * @method LesvgpTitre[]    findAll()
 * @method LesvgpTitre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LesvgpTitreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LesvgpTitre::class);
    }

    // /**
    //  * @return LesvgpTitre[] Returns an array of LesvgpTitre objects
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
    public function findOneBySomeField($value): ?LesvgpTitre
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
