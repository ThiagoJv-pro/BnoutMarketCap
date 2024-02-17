<?php

namespace App\Entity;

use App\Repository\CoinPriceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoinPriceRepository::class)]
class CoinPrice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?string $symbol = null;

    #[ORM\Column]
    private ?float $currentValue = null;

    #[ORM\Column]
    private ?float $volumeUsd1Hr = null;

    #[ORM\Column]
    private ?float $volumeUsd24Hr = null;
    
    private ?Chart $chart = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;
        return $this;
    }

    public function getChart(): ?Chart
    {
        return $this->chart;
    }

    public function setChart(?Chart $chart): static
    {
        $this->chart = $chart;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCurrentValue(): ?float
    {
        return $this->currentValue;
    }

    public function setCurrentValue(float $currentValue): static
    {
        $this->currentValue = $currentValue;

        return $this;
    }

    public function getVolumeUsd1Hr(): ?float
    {
        return $this->volumeUsd1Hr;
    }

    public function setVolumeUsd1Hr(float $volumeUsd1Hr): static
    {
        $this->volumeUsd1Hr = $volumeUsd1Hr;

        return $this;
    }

    public function getVolumeUsd24Hr(): ?float
    {
        return $this->volumeUsd24Hr;
    }

    public function setVolumeUsd24Hr(float $volumeUsd24Hr): static
    {
        $this->volumeUsd24Hr = $volumeUsd24Hr;

        return $this;
    }

    public function addCoinPrice($chart)
    {
        $this->chart = $chart;
        $this->setSymbol($this->chart->getSymbol());
        $this->setCurrentValue($this->chart->getCurrentAmount());
        $this->setVolumeUsd1Hr($this->chart->getVolumeUsd1Hr());
        $this->setVolumeUsd24Hr($this->chart->getVolumeUsd24Hr());
        $this->setDate($this->chart->getDate());

    }
}
