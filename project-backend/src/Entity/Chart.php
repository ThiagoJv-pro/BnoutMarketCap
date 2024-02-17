<?php

namespace App\Entity;

use App\Repository\ChartRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChartRepository::class)]
class Chart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(targetEntity: CoinPrice::class, mappedBy: 'coinPrice', cascade: ['persist'])]
    #[ORM\JoinColumn(name: 'coin_price_id', referencedColumnName: 'id')]
    private ?CoinPrice $coinPrice = null;
    
    private ?string $nameCoin = null;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $symbol = null;

    #[ORM\Column]
    private ?float $currentAmount = null;

    #[ORM\Column]
    private ?float $volumeUsd24Hr = null;

    #[ORM\Column]
    private ?float $volumeUsd1Hr = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameCoin(): ?string
    {
        return $this->nameCoin;
    }

    public function setNameCoin(string $nameCoin): static
    {
        $this->nameCoin = $nameCoin;

        return $this;
    }

    public function getCurrentAmount(): ?float
    {
        return $this->currentAmount;
    }

    public function setCurrentAmount(float $currentAmount): static
    {
        $this->currentAmount = $currentAmount;

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

    public function getVolumeUsd1Hr(): ?float
    {
        return $this->volumeUsd1Hr;
    }

    public function setVolumeUsd1Hr(float $volumeUsd1Hr): static
    {
        $this->volumeUsd1Hr = $volumeUsd1Hr;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function setSymbol(string $symbol): static
    {
        $this->symbol = $symbol;
        return $this;
    }

    public function getSymbol(): ?string
    {
        return $this->symbol;
    }

}
