<?php

namespace App\Repository;

use App\Entity\Activitys;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Activitys|null find($id, $lockMode = null, $lockVersion = null)
 * @method Activitys|null findOneBy(array $criteria, array $orderBy = null)
 * @method Activitys[]    findAll()
 * @method Activitys[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActivitysRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Activitys::class);
    }

    // /**
    //  * @return Activitys[] Returns an array of Activitys objects
    //  */
    public function findByResult($city, $price=1)
    {
        if(!$city)$city="paris";
        return $this->createQueryBuilder('a')
            ->andWhere('a.Ville LIKE :val')
            ->andWhere('a.Prices <= :price')
            ->setParameter('val', '%'.$city.'%')
            ->setParameter('price', $price)
            ->orderBy('a.id', 'DESC')
            ->setMaxResults(50)
            ->getQuery()
            ->getResult()
        ;
    }
    
    public function findByPostCode($city)
    {
        if(!$city)$city="paris";
        return $this->createQueryBuilder('a')
            ->Where('a.postcode LIKE :val')
            ->setParameter('val', $city.'%')
            ->orderBy('a.id', 'DESC')
            ->setMaxResults(50)
            ->getQuery()
            ->getResult()
        ;
    }
    
    public function findByCat($cat)
    {
        if(!$cat)$cat="sport";
        return $this->createQueryBuilder('a')
            ->Where('a.Title LIKE :val')
            ->orWhere('a.Description LIKE :val')
            ->setParameter('val', '%'.$cat.'%')
            ->orderBy('a.id', 'DESC')
            ->setMaxResults(50)
            ->getQuery()
            ->getResult()
        ;
    }
    
    // /**
    //  * @return Activitys[] Returns an array of Activitys objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Activitys
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
