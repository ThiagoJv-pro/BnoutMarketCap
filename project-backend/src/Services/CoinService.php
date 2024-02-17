<?php

namespace App\Services;

use App\Entity\Coin;
use App\Entity\Cryptocurrencys;
use App\Entity\TraditionalCurrency;
use Doctrine\ORM\EntityManagerInterface;

class CoinService
{

    public function __construct
    (
        private EntityManagerInterface $em,
        private TraitService $traitService
    ) {
    }
    public function getInfoCoin(): array
    {
        $merge = array_merge($this->getListCrypto(), $this->getListTraditionalCurrency());
        $this->saveCoinInfo($merge);
        return $merge;
    }

    public function saveCoinInfo(array $info): void
    {
        foreach ($info as $value) {
            $coinInfo = $this->em->getRepository(Coin::class)->findOneBy(["symbol" => $value["symbol"]]);

            if (!$coinInfo) {
                $this->traitService->saveNewEntity(Coin::class, array(
                    $value["name"],
                    $value["symbol"],
                    isset($value["Price"]) ? $value["Price"] : 1.0
                )
                );
            } else {
                $this->traitService->updateEntity($coinInfo, array(
                    $value["name"],
                    $value["symbol"],
                    isset($value["Price"]) ? $value["Price"] : 1.0
                )
                );
            }
        }
    }

    //Recupera todas os registros de cryptomoedas
    public function getListCrypto(): array
    {
        $cryptoList = $this->em->getRepository(Cryptocurrencys::class)->getCryptoCurrencyQB();

        return $cryptoList;
    }

    public function getListTraditionalCurrency(): array
    {
        $currencyList = $this->em->getRepository(TraditionalCurrency::class)->getTraditionalCurrencyQB();

        return $currencyList;
    }

    public function getFavoriteCrypto(): array
    {
        $cryptoList = $this->em->getRepository(Cryptocurrencys::class)->getFavoriteListCryptoCurrencyQB();

        return $cryptoList;
    }

    public function getFavoriteTraditionalCurrency(): array
    {

        $currencyList = $this->em->getRepository(TraditionalCurrency::class)->getFavoriteTraditionalCurrencyQB();

        return $currencyList;
    }

}