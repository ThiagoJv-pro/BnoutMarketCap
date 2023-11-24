<?php

namespace App\Repository;

use App\Entity\TraditionalCurrency;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TraditionalCurrency>
 *
 * @method TraditionalCurrency|null find($id, $lockMode = null, $lockVersion = null)
 * @method TraditionalCurrency|null findOneBy(array $criteria, array $orderBy = null)
 * @method TraditionalCurrency[]    findAll()
 * @method TraditionalCurrency[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TraditionalCurrencyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TraditionalCurrency::class);
    }

//    /**
//     * @return TraditionalCurrency[] Returns an array of TraditionalCurrency objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TraditionalCurrency
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
