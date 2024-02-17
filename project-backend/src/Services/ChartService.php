<?php

namespace App\Services;

use App\Services\CoinService;
use App\Entity\Coin;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Chart;
use App\Entity\CoinPrice;
use DateTime;

class ChartService
{

    public function __construct
    (
        private Chart $chart,
        private CoinService $coinService,
        private Coin $coin,
        private EntityManagerInterface $em,
        private TraitService $traitService
    ) {
    }

    public function updateChart()
    {
        $consultCoin = $this->em->getRepository(Coin::class)
            ->allData();

        foreach ($consultCoin as $coin) {
            $coinCheck = $this->em->getRepository(Chart::class)->findOneBy(['symbol' => $coin['symbol']]);
            $coinPrice = new CoinPrice();

            if (empty($coinCheck)) {
                $newDataChart = $this->traitService->saveNewEntity(
                    Chart::class,
                    array(
                        $coin['name'],
                        $coin['value'],
                        $this->amountRegisterTime($coin, true, new DateTime),
                        $this->amountRegisterTime($coin, false, new DateTime),
                        new DateTime,
                        $coin['symbol'],
                    )
                );

                $coinPrice->addCoinPrice($newDataChart);
                $this->em->persist($coinPrice);
            } else {
                $updateEntity = $this->traitService->updateEntity(
                    $coinCheck,
                    array(
                        $coin['name'],
                        $coin['value'],
                        $this->amountRegisterTime($coin, true, new DateTime),
                        $this->amountRegisterTime($coin, false, new DateTime),
                        new DateTime,
                        $coin['symbol'],
                    )
                );

                $coinPrice->addCoinPrice($updateEntity);
                $this->em->persist($coinPrice);
            }

        }
    }

    public function amountRegisterTime($chart, bool $volHrs = false, $dateNow): float
    {
        $amount = $chart['value'];
        $date = $dateNow;

        if ($volHrs) {
            if ($date != new DateTime) {
                return $amount;
            }
        }
        if ($date != new DateTime) {
            return $amount;
        }

        return $amount;
    }

}