<?php

namespace App\Entity;

use App\Repository\LinkRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LinkRepository::class)]
class Link
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $regular = null;

    #[ORM\Column(length: 255)]
    private ?string $short = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegular(): ?string
    {
        return $this->regular;
    }

    public function setRegular(string $regular): static
    {
        $this->regular = $regular;

        return $this;
    }

    public function getShort(): ?string
    {
        return $this->short;
    }

    public function setShort(string $short): static
    {
        $this->short = $short;

        return $this;
    }
}
