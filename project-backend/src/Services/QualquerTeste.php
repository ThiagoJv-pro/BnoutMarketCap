<?php

namespace App\Services;

class QualquerTeste
{

    private $teste;


    public function testar($testeParams)
    {
        $this->teste = $testeParams;
       
    }

    public function getTestar()
    {
        return $this->teste;
    }
}