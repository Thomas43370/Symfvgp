<?php

namespace App\Repository;

use App\Entity\LesvgpMarque;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LesvgpMarque|null find($id, $lockMode = null, $lockVersion = null)
 * @method LesvgpMarque|null findOneBy(array $criteria, array $orderBy = null)
 * @method LesvgpMarque[]    findAll()
 * @method LesvgpMarque[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LesvgpMarqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LesvgpMarque::class);
    }

    // /**
    //  * @return LesvgpMarque[] Returns an array of LesvgpMarque objects
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
    public function findOneBySomeField($value): ?LesvgpMarque
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
