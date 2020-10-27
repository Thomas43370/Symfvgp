<?php

namespace App\Repository;

use App\Entity\LesvgpDonneesMembres;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LesvgpDonneesMembres|null find($id, $lockMode = null, $lockVersion = null)
 * @method LesvgpDonneesMembres|null findOneBy(array $criteria, array $orderBy = null)
 * @method LesvgpDonneesMembres[]    findAll()
 * @method LesvgpDonneesMembres[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LesvgpDonneesMembresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LesvgpDonneesMembres::class);
    }

    // /**
    //  * @return LesvgpDonneesMembres[] Returns an array of LesvgpDonneesMembres objects
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
    public function findOneBySomeField($value): ?LesvgpDonneesMembres
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
