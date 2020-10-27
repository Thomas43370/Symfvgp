<?php

namespace App\Repository;

use App\Entity\LesvgpMatcli;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LesvgpMatcli|null find($id, $lockMode = null, $lockVersion = null)
 * @method LesvgpMatcli|null findOneBy(array $criteria, array $orderBy = null)
 * @method LesvgpMatcli[]    findAll()
 * @method LesvgpMatcli[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LesvgpMatcliRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LesvgpMatcli::class);
    }

    // /**
    //  * @return LesvgpMatcli[] Returns an array of LesvgpMatcli objects
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
    public function findOneBySomeField($value): ?LesvgpMatcli
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
