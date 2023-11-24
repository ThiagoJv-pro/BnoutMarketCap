<?php

namespace App\Entity;

use App\Repository\CryptocurrencyRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: CryptocurrencyRepository::class)]
class Cryptocurrencys
//Comando para dar um reset na contagem dos ids no banco de dados 
//ALTER SEQUENCE cryptocurrency_id_seq RESTART WITH 1;
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id = null;

    #[ORM\Column]
    private ?string $idCurrency = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $Price = null;

    #[ORM\Column]
    private ?float $Volume = null;

    #[ORM\Column(length: 255)]
    private ?string $symbol = null;


    public function getIdCurrency(): ?string{
        return $this->idCurrency;
    }

    public function setIdCurrency(?string $idCurrency): static
    {
        $this->idCurrency = $idCurrency;

        return $this;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->Price;
    }

    public function setPrice(float $Price): static
    {
        $this->Price = $Price;

        return $this;
    }

    public function getVolume(): ?float
    {
        return $this->Volume;
    }

    public function setVolume(float $Volume): static
    {
        $this->Volume = $Volume;

        return $this;
    }

    public function getSymbol(): ?string
    {
        return $this->symbol;
    }

    public function setSymbol(string $symbol): static
    {
        $this->symbol = $symbol;

        return $this;
    }


   public function decimalValue(float $value){
        $value = number_format($value, 2 ,".","");
        $this->setPrice(floatval($value));
        return $this->getPrice();
    }

}
