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

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Coin $nameCoin = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Coin $idCoin = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Coin $currentAmount = null;

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

    public function getNameCoin(): ?Coin
    {
        return $this->nameCoin;
    }

    public function setNameCoin(?Coin $nameCoin): static
    {
        $this->nameCoin = $nameCoin;

        return $this;
    }

    public function getIdCoin(): ?Coin
    {
        return $this->idCoin;
    }

    public function setIdCoin(?Coin $idCoin): static
    {
        $this->idCoin = $idCoin;

        return $this;
    }

    public function getCurrentAmount(): ?Coin
    {
        return $this->currentAmount;
    }

    public function setCurrentAmount(?Coin $currentAmount): static
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
}
