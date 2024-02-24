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
            $_ENV['NEWS_URL']
        );

        $data = $response->toArray();

        return $data;
    }
}

