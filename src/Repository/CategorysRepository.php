<?php

namespace App\Repository;

use App\Entity\Categorys;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Categorys|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categorys|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categorys[]    findAll()
 * @method Categorys[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorysRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Categorys::class);
    }

    // /**
    //  * @return Categorys[] Returns an array of Categorys objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Categorys
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
