<?php

namespace App\Message;

use App\Entity\Email;

class CoinListEmail
{
    private Email $email;
    public  function __construct 
    (
        public string $address,
        public string $typeCoin
    )
    {
        $this->email = new Email();
        $this->email->setAddress($address);
        $this->email->setRequestCoin($typeCoin);
    }

    public function getEmailAddress()
    {
        return $this->email->getAddress();
    }

    public function getRequestCoin()
    {
        return $this->email->getRequestCoin();
    }
}
