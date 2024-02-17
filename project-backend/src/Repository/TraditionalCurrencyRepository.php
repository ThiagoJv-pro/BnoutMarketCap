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


    public function getTraditionalCurrencyQB(): array
    {
       return $this->createQueryBuilder('t')
        ->select('t.name, t.symbol, t.Price')
        ->getQuery()
        ->getArrayResult();
    }

    public function getFavoriteTraditionalCurrencyQB(): array
    {
       return $this->createQueryBuilder('t')
        ->select('t.name, t.symbol, t.Price')
        ->getQuery()
        ->setMaxResults(3)
        ->getArrayResult();
    }
}
