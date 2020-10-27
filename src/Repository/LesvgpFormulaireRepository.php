<?php

namespace App\Repository;

use App\Entity\LesvgpFormulaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LesvgpFormulaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method LesvgpFormulaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method LesvgpFormulaire[]    findAll()
 * @method LesvgpFormulaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LesvgpFormulaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LesvgpFormulaire::class);
    }

    // /**
    //  * @return LesvgpFormulaire[] Returns an array of LesvgpFormulaire objects
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
    public function findOneBySomeField($value): ?LesvgpFormulaire
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
