<?php

namespace App\Repository;

use App\Entity\Cryptocurrencys;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cryptocurrencys>
 *
 * @method Cryptocurrency|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cryptocurrency|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cryptocurrency[]    findAll()
 * @method Cryptocurrency[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CryptocurrencyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cryptocurrencys::class);
    }

    public function getCryptoCurrencyQB(): array
    {
       return $this->createQueryBuilder('c')
       ->select('c.name, c.symbol, c.Price')
       ->getQuery()
       ->getArrayResult();
    }

    public function getFavoriteListCryptoCurrencyQB(): array
    {
       return $this->createQueryBuilder('c')
       ->select('c.name, c.symbol, c.Price')
       ->getQuery()
       ->setMaxResults(3)
       ->getArrayResult();
    }
}
