<?php

namespace App\Repository;

use App\Entity\LesvgpModele;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LesvgpModele|null find($id, $lockMode = null, $lockVersion = null)
 * @method LesvgpModele|null findOneBy(array $criteria, array $orderBy = null)
 * @method LesvgpModele[]    findAll()
 * @method LesvgpModele[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LesvgpModeleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LesvgpModele::class);
    }

    // /**
    //  * @return LesvgpModele[] Returns an array of LesvgpModele objects
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
    public function findOneBySomeField($value): ?LesvgpModele
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
