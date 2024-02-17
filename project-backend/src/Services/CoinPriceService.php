<?php

namespace App\Services;

use App\Entity\CoinPrice;
use Doctrine\ORM\EntityManagerInterface;

class CoinPriceService
{
    
    public function __construct
    (
        private EntityManagerInterface $em
    )
    {
    }

    public function getCoinPriceBySymbol(string $symbol)
    {
       $coin = array();
       $results = $this->em->getRepository(CoinPrice::class)
       ->findByField($symbol);

       foreach($results as $coinPrice)
       {
            $coin[] = array(
                "Symbol" => $coinPrice->getSymbol(),
                "CurrentValue" => $coinPrice->getCurrentValue(),
                "volumeUsd1Hr" => $coinPrice->getVolumeUsd1Hr(),
                "volumeUsd24Hr" => $coinPrice->getVolumeUsd24Hr(),
                "Date" => date_format($coinPrice->getDate(), 'd-m-Y H:i')
            );
       }
       return $coin;
    }

}

