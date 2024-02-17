<?php

namespace App\Services;

use App\Entity\Converter;
use Doctrine\ORM\EntityManagerInterface;

class TraitService
{
    public function __construct
    (
        private EntityManagerInterface $em,
        private Converter $converterService,
    ) {
    }

    # SaveEntity ira receber um atributo e um valor
    public function saveNewEntity($classEntity, $params)
    {
        $counter = 0;
        $methods = $this->getMethodsByClass($classEntity, 's');
        $classEntityObject = new $classEntity();

        foreach ($methods as $method) {
            $this->em->persist(
                call_user_func(
                    array($classEntityObject, $method),
                    $params[$counter]
                )
            );
            $counter += 1;
        }

        $this->flush();

        return $classEntityObject;
    }

    public function updateEntity($classEntity, $params)
    {
        $counter = 0;
        $methods = $this->getMethodsByClass($classEntity, 's');

        foreach ($methods as $method) {
            $this->em->persist(
                call_user_func(
                    array($classEntity, $method),
                    $params[$counter]
                )
            );
            $counter += 1;
        }

        $this->flush();

        return $classEntity;
    }
    //Get methods of class (Gatters or Setters)
    public function getMethodsByClass($classEntity, $char): array
    {
        $methods = [];
        $classMethods = get_class_methods($classEntity);

        foreach ($classMethods as $method) {
            if (substr($method, 0, 1) == $char) {
                $methods[] = $method;
            }
        }
        return $methods;
    }

    public function flush()
    {
        return $this->em->flush();
    }
}