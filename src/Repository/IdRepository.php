<?php

namespace App\Repository;

use App\Entity\Id;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Id|null find($id, $lockMode = null, $lockVersion = null)
 * @method Id|null findOneBy(array $criteria, array $orderBy = null)
 * @method Id[]    findAll()
 * @method Id[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IdRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Id::class);
    }

    // /**
    //  * @return Id[] Returns an array of Id objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Id
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
