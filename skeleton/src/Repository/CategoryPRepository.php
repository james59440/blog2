<?php

namespace App\Repository;

use App\Entity\CategoryP;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CategoryP|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryP|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryP[]    findAll()
 * @method CategoryP[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryPRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CategoryP::class);
    }

    // /**
    //  * @return CategoryP[] Returns an array of CategoryP objects
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
    public function findOneBySomeField($value): ?CategoryP
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
