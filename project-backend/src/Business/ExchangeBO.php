<?php

namespace App\Business;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class ExchangeBO
{
    public EntityManagerInterface $em;
    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }

    public function getExchange(){
        
    }


}