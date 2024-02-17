<?php

namespace App\Api;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class newsApi
{
    public function __construct
    (
        private HttpClientInterface $httpClientInterface
    )
    {}

    public function getNewsData()
    {
        $response = $this->httpClientInterface->request
        (
            'GET',
            'https://www.alphavantage.co/query?function=NEWS_SENTIMENT&tickers=COIN,CRYPTO:BTC,FOREX:USD&time_from=20220410T0130&limit=1000&apikey=VIP0R0SKGEARFPR8'
        );

        $data = $response->toArray();

        return $data;
    }
}

