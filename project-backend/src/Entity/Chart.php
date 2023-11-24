<?php

namespace App\Entity;

use App\Repository\ChartRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChartRepository::class)]
class Chart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $CoinName = null;

    #[ORM\Column(length: 255)]
    private ?string $IdCoin = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCoinName(): ?string
    {
        return $this->CoinName;
    }

    public function setCoinName(?string $CoinName): static
    {
        $this->CoinName = $CoinName;

        return $this;
    }

    public function getIdCoin(): ?string
    {
        return $this->IdCoin;
    }

    public function setIdCoin(string $IdCoin): static
    {
        $this->IdCoin = $IdCoin;

        return $this;
    }
}
