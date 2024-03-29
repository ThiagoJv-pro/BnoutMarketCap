<?php

namespace App\Services;

use App\Entity\Cryptocurrencys;
use Doctrine\ORM\EntityManagerInterface;

class CryptocurrencyService
{
    public EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getCryptoCurrencysFromApi(array $data)
    {
        try {
            if (isset($data)) {
                foreach ($data as $value) {
                    $id = $value['id_currency'];

                    $crypto = $this->em
                        ->getRepository(Cryptocurrencys::class)
                        ->findOneBy(['idCurrency' => $id]);

                    if (!$crypto) {
                        $crypto = new Cryptocurrencys();

                        $crypto->setIdCurrency($value['id_currency']);
                        $crypto->setName($value['name']);
                        $crypto->setPrice($crypto->decimalValue($value['price']));
                        $crypto->setVolume($value['volume by hours (24hrs)']);
                        $crypto->setSymbol($value['symbol']);
                    }

                    $crypto->setName($value['name']);
                    $crypto->setPrice($crypto->decimalValue($value['price']));
                    $crypto->setVolume($value['volume by hours (24hrs)']);
                    $crypto->setSymbol($value['symbol']);

                    $this->em->persist($crypto);
                }
            }

            $this->em->flush();

            return $data;
        } catch (\Exception $e) {
            throw new $e('Erro ao processar dados');
        }
    }
}
