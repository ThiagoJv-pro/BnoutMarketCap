<?php

namespace App\Business;

use App\Entity\Coin;
use App\Entity\Cryptocurrencys;
use App\Entity\TraditionalCurrency;
use Doctrine\ORM\EntityManagerInterface;
class CoinBO
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct
    (
        EntityManagerInterface $em
    )
    {
        $this->em = $em;
    }
    public function getInfoCoin(): array
    {
        $traditionalCurrency = $this->em->createQueryBuilder()
        ->select('t.name, t.symbol, t.Price')
        ->from(TraditionalCurrency::class, 't')
        ->getQuery()
        ->getArrayResult();

        $cryptoCurrency = $this->em->createQueryBuilder()
        ->select('c.name, c.symbol, c.Price')
        ->from(Cryptocurrencys::class, 'c')
        ->getQuery()
        ->getArrayResult();

        $union = array_merge($traditionalCurrency, $cryptoCurrency);

        $this->saveInfoCoin($union);

        return $union;
    }

    public function saveInfoCoin(array $info): void
    {
        foreach($info as $value)
        {
            $coinInfo = $this->em->getRepository(Coin::class)->findOneBy(["symbol" => $value["symbol"]]);
            if (!$coinInfo) {
                $coinInfo = new Coin();
                $coinInfo->setName($value["name"]);
                $coinInfo->setSymbol($value["symbol"]);
                isset($value["Price"]) ? $coinInfo->setValue($value["Price"]) : $coinInfo->setValue(1.0);
                $this->em->persist($coinInfo);
            }

            $coinInfo->setName($value["name"]);
            $coinInfo->setSymbol($value["symbol"]);
            isset($value["Price"]) ? $coinInfo->setValue($value["Price"]) : $coinInfo->setValue(1.0);
            
            $this->em->persist($coinInfo);
        }

        $this->em->flush();
    }
}