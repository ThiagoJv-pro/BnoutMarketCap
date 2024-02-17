<?php

namespace App\Services;

use App\Entity\Email;

class EmailService
{

     public function __construct
     (
          private TraitService $traitService,
     ) {
     }
     public function emailRegister(string $address, string $type)
     {
          $this->traitService->saveNewEntity(Email::class, array(
               $address,
               new \DateTime,
               false,
               $type
          )
          );
     }
}