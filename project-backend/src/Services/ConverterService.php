<?php

namespace App\Services;

class ConverterService
{
    public function __construct
    (

    ) {

    }

    public function Converter(float $priceFrom, float $priceTo, bool $inverter = false): float
    {
        if ($inverter && ($priceFrom != 0 || $priceTo != 0)) {
            $resultConverter = $priceFrom / $priceTo;
        } else {
            $resultConverter = $priceFrom * $priceTo;
        }
    
        return $resultConverter;
    }

}