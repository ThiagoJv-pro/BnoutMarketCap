<?php

namespace App\Api;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class exchangeApi{
    public function __construct(
        private HttpClientInterface $httpClientInterface
    ){
    }

    public function requestExchange()
    {
        $response = $this->httpClientInterface->request(
            'GET',
            'https://api.apilayer.com/exchangerates_data/latest?symbols=BRL&base=USD',
            ['headers' => ['apikey' => '0w32WnVLsMtiLKHJ7ArQQStJLtmccCL6' ]]       
            );

            $data = $response->toArray();

            return $data;
    }

    public function requestSymbols():array
    {
        $response = $this->httpClientInterface->request(
            'GET',
            'https://api.apilayer.com/exchangerates_data/symbols',
            ['headers' => ['apikey' => '0w32WnVLsMtiLKHJ7ArQQStJLtmccCL6' ]]       
            );

            $data = $response->toArray();

            return $data;
    }

    public function requestCurrentQuoteByUsd(){
        $response = $this->httpClientInterface->request(
            'GET',
            'https://api.apilayer.com/exchangerates_data/latest?base=USD',
            ['headers' => ['apikey' => '0w32WnVLsMtiLKHJ7ArQQStJLtmccCL6' ]]
        );

        $data = $response->toArray();
        return $data;
    }

}
