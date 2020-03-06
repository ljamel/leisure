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
    public function findByResult($city="paris", $price=1, $type=null)
    {
 
        return $this->createQueryBuilder('a')
            ->Where('a.Ville = :val')
            ->andWhere('a.Description LIKE :type')
            ->andWhere('a.Prices <= :price')
            ->setParameter('type', '%'.$type.'%')
            ->setParameter('val', $city)
            ->setParameter('price', $price)
            ->orderBy('a.id', 'DESC')
            ->setMaxResults(50)
            ->getQuery()
            ->getResult()
        ;
    }
    
    public function findByPage($arr, $order, $limit, $page){
        return $this->createQueryBuilder('a')
            ->orderBy('a.id', 'DESC')
            ->setFirstResult($page)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
        ;
    }
    
    public function findByPostCode($city)
    {
//        dd($city);
        if(!$city)$city="75";
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
        $cats = explode(" ", $cat);
//        dd($cats);
        if(!$cat)$cat="sport";
        $result = array();
        foreach($cats as $key => $cat ){
            $result[] = $this->createQueryBuilder('a')
                ->Where('a.Description LIKE :val')
                ->setParameter('val', '%'.$cat.'%')
                ->orderBy('a.id', 'DESC')
                ->setMaxResults(50)
                ->getQuery()
                ->getResult()
            ;
            
            if(count($result[$key]) === 0){
                unset($result[$key]);
            }
        }
        
        return $result;
        
    }
    
    public function nbActivitys()
    {
        return $this->createQueryBuilder('a')
               ->Where('a.publish = :val')
               ->setParameter('val', 1)
               ->select('count(a.Title)')
               ->setMaxResults(1)
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
