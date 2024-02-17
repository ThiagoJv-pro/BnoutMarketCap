<?php
namespace App\Services;

use App\Api\exchangeApi;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\TraditionalCurrency;
use App\Services\TraitService;

class TraditionalCurrencyBO
{
    public function __construct
    (
        private EntityManagerInterface $em,
        private ExchangeApi $exchangeApi,
        private TraitService $traitService
    ) {
    }
    public function getTraditionalCurrencyFromApi(bool $getData = false): array
    {
        if ($getData) {
            $dataCurrency = [];
            $dataTraditionalCurrency = $this->exchangeApi->requestSymbols();
            $dataTraditionalCurrencyValue = $this->exchangeApi->requestCurrentQuoteByUsd();

            foreach ($dataTraditionalCurrency["symbols"] as $symbol => $name) {
                $dataCurrency[] = array(
                    "Name" => $name,
                    "Symbol" => $symbol,
                    "Price" => !empty($dataTraditionalCurrencyValue["rates"][$symbol]) ? $dataTraditionalCurrencyValue["rates"][$symbol] : null
                );
            }
            ;

            $this->setTraditionalCurrency($dataCurrency);
            return $dataCurrency;
        }
    }

    public function setTraditionalCurrency(array $data): void
    {
        foreach ($data as $tc) {
            $tCurrency = $this->em
                ->getRepository(TraditionalCurrency::class)
                ->findOneBy(['symbol' => $tc["Symbol"]]);

            if (!$tCurrency) {
                $this->traitService->saveNewEntity(
                    TraditionalCurrency::class,
                    [$tc["Name"], $tc["Price"], $tc["Symbol"]]
                );
            }

            $tCurrency->setName($tc["Name"]);
            $tCurrency->setSymbol($tc["Symbol"]);
            $tCurrency->setPrice($tc["Price"]);

            $this->em->persist($tCurrency);
        }

        $this->em->flush();
    }


}