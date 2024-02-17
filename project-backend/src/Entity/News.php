<?php

namespace App\Entity;

use App\Repository\NewsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NewsRepository::class)]
class News
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $title = null;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $url = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $timePublished = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private ?array $authors = null;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $summary = null;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $bannerImage = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private ?array $topics = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getTimePublished(): ?\DateTimeInterface
    {
        return $this->timePublished;
    }

    public function setTimePublished(?\DateTimeInterface $timePublished): static
    {
        $this->$timePublished = $timePublished;

        return $this;
    }

    public function getAuthors(): ?array
    {
        return $this->authors;
    }

    public function setAuthors(?array $authors): static
    {
        $this->authors = $authors;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(?string $summary): static
    {
        $this->summary = $summary;

        return $this;
    }

    public function getBannerImage(): ?string
    {
        return $this->bannerImage;
    }

    public function setBannerImage(?string $bannerImage): static
    {
        $this->bannerImage = $bannerImage;

        return $this;
    }

    public function getTopics(): ?array
    {
        return $this->topics;
    }

    public function setTopics(?array $topics): static
    {
        $this->topics = $topics;

        return $this;
    }
}
