<?php

namespace App\Entity;

use App\Repository\ConverterRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConverterRepository::class)]
class Converter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $toCoinSymbol = null;

    #[ORM\Column(nullable: true)]
    private ?float $toPrice = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fromCoinSymbol = null;

    #[ORM\Column(nullable: true)]
    private ?float $fromPrice = null;

    #[ORM\Column(nullable: true)]
    private ?float $conversion = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getToCoinSymbol(): ?string
    {
        return $this->toCoinSymbol;
    }

    public function setToCoinSymbol(?string $toCoinSymbol): static
    {
        $this->toCoinSymbol = $toCoinSymbol;

        return $this;
    }

    public function getToPrice(): ?float
    {
        return $this->toPrice;
    }

    public function setToPrice(?float $toPrice): static
    {
        $this->toPrice = $toPrice;

        return $this;
    }

    public function getFromCoinSymbol(): ?string
    {
        return $this->fromCoinSymbol;
    }

    public function setFromCoinSymbol(?string $fromCoinSymbol): static
    {
        $this->fromCoinSymbol = $fromCoinSymbol;

        return $this;
    }

    public function getFromPrice(): ?float
    {
        return $this->fromPrice;
    }

    public function setFromPrice(?float $fromPrice): static
    {
        $this->fromPrice = $fromPrice;

        return $this;
    }

    public function getConversion(): ?float
    {
        return $this->conversion;
    }

    public function setConversion(?float $conversion): static
    {
        $this->conversion = $conversion;

        return $this;
    }
}
