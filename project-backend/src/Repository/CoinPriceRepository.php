<?php

namespace App\Repository;

use App\Entity\CoinPrice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CoinPrice>
 *
 * @method CoinPrice|null find($id, $lockMode = null, $lockVersion = null)
 * @method CoinPrice|null findOneBy(array $criteria, array $orderBy = null)
 * @method CoinPrice[]    findAll()
 * @method CoinPrice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoinPriceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CoinPrice::class);
    }

   public function findByField($symbol): array
   {
       return $this->createQueryBuilder('c')
           ->andWhere('c.symbol = :symbol')
           ->setParameter('symbol', $symbol)
           ->orderBy('c.id', 'ASC')
           ->setMaxResults(10)
           ->getQuery()
           ->getResult();
       ;
   }

}
