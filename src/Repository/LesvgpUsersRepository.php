<?php

namespace App\Repository;

use App\Entity\LesvgpUsers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LesvgpUsers|null find($id, $lockMode = null, $lockVersion = null)
 * @method LesvgpUsers|null findOneBy(array $criteria, array $orderBy = null)
 * @method LesvgpUsers[]    findAll()
 * @method LesvgpUsers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LesvgpUsersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LesvgpUsers::class);
    }

    // /**
    //  * @return LesvgpUsers[] Returns an array of LesvgpUsers objects
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
    public function findOneBySomeField($value): ?LesvgpUsers
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
