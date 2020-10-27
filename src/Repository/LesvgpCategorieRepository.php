<?php

namespace App\Repository;

use App\Entity\LesvgpCategorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LesvgpCategorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method LesvgpCategorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method LesvgpCategorie[]    findAll()
 * @method LesvgpCategorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LesvgpCategorieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LesvgpCategorie::class);
    }

    // /**
    //  * @return LesvgpCategorie[] Returns an array of LesvgpCategorie objects
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
    public function findOneBySomeField($value): ?LesvgpCategorie
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
