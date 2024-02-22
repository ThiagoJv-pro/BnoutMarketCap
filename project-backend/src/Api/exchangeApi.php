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
            $_ENV['EXCHANGE_LATEST'],
            ['headers' => ['apikey' => $_ENV['EXCHANGE_KEY'] ]]       
            );

            $data = $response->toArray();

            return $data;
    }

    public function requestSymbols():array
    {
        $response = $this->httpClientInterface->request(
            'GET',
            $_ENV['EXCHANGE_SYMBOLS'],
            ['headers' => ['apikey' => $_ENV['EXCHANGE_KEY'] ]]        
            );

            $data = $response->toArray();

            return $data;
    }

    public function requestCurrentQuoteByUsd(){
        $response = $this->httpClientInterface->request(
            'GET',
            $_ENV['EXCHANGE_LATEST_USD'],
            ['headers' => ['apikey' => $_ENV['EXCHANGE_KEY'] ]]
        );

        $data = $response->toArray();
        return $data;
    }

}
