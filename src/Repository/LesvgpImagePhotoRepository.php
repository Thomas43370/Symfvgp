<?php

namespace App\Repository;

use App\Entity\LesvgpImagePhoto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LesvgpImagePhoto|null find($id, $lockMode = null, $lockVersion = null)
 * @method LesvgpImagePhoto|null findOneBy(array $criteria, array $orderBy = null)
 * @method LesvgpImagePhoto[]    findAll()
 * @method LesvgpImagePhoto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LesvgpImagePhotoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LesvgpImagePhoto::class);
    }

    // /**
    //  * @return LesvgpImagePhoto[] Returns an array of LesvgpImagePhoto objects
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
    public function findOneBySomeField($value): ?LesvgpImagePhoto
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
