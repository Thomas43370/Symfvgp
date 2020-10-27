<?php

namespace App\Repository;

use App\Entity\LesvgpClients;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LesvgpClients|null find($id, $lockMode = null, $lockVersion = null)
 * @method LesvgpClients|null findOneBy(array $criteria, array $orderBy = null)
 * @method LesvgpClients[]    findAll()
 * @method LesvgpClients[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LesvgpClientsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LesvgpClients::class);
    }

    // /**
    //  * @return LesvgpClients[] Returns an array of LesvgpClients objects
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
    public function findOneBySomeField($value): ?LesvgpClients
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
