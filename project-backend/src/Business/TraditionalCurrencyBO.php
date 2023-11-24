<?php
namespace App\Business;

use App\Api\exchangeApi;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\TraditionalCurrency;

class TraditionalCurrencyBO
{

    private $em;
    private $exchangeApi;
    public function __construct(
         EntityManagerInterface $em, 
         ExchangeApi $exchangeApi)
    {
        $this->em = $em;
        $this->exchangeApi = $exchangeApi;
    }
    public function getTraditionalCurrencyFromApi(): array
    {
        $dataCurrency = [];
        $dataTraditionalCurrency = $this->exchangeApi->requestSymbols();

        foreach ($dataTraditionalCurrency["symbols"] as $symbol => $name)
        {
            $dataCurrency[] = array(
                "Name" => $name,
                "Symbol" => $symbol
            );
        }

        $this->setTradionalCurrency($dataCurrency);
        return $dataCurrency;
    }

    public function setTradionalCurrency(array $data): void
    {   
        foreach($data as $tc){
            $tCurrency = $this->em
            ->getRepository(TraditionalCurrency::class)
            ->findOneBy(['symbol' => $tc["Symbol"]]);

            if (!$tCurrency) {
                $tCurrency = new TraditionalCurrency();
                $tCurrency->setName($tc["Name"]);
                $tCurrency->setSymbol($tc["Symbol"]);
            }
            $tCurrency->setName($tc["Name"]);
            $tCurrency->setSymbol($tc["Symbol"]);

            $this->em->persist($tCurrency);
        }

        $this->em->flush();
    }

}