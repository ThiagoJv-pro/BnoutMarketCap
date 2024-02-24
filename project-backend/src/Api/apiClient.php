<?php

namespace App\Api;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpClient\HttpClient;

class apiClient{

    public function __construct 
    (
        private HttpClientInterface $client
    ){
    }
    
    public function getData(): array{

        $response = $this->client->request(
            'GET',
            $_ENV['COINCAP_URL']
        );
        $data = $response->toArray();
        $result = array();
            foreach($data['data'] as $value){
                $result[] = array(
                    'id_currency' => $value['id'],
                    'name'=> $value['name'],
                    'price'=> $value['priceUsd'],
                    'volume by hours (24hrs)' => $value['volumeUsd24Hr'],
                    'symbol' => $value['symbol'],
                );
            }
        return $result;
    }
}