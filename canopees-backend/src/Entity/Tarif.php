<?php

namespace App\Entity;

use App\Repository\TarifRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TarifRepository::class)]
class Tarif
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titreBloc = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $texteTarifs = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreBloc(): ?string
    {
        return $this->titreBloc;
    }

    public function setTitreBloc(string $titreBloc): static
    {
        $this->titreBloc = $titreBloc;

        return $this;
    }

    public function getTexteTarifs(): ?string
    {
        return $this->texteTarifs;
    }

    public function setTexteTarifs(string $texteTarifs): static
    {
        $this->texteTarifs = $texteTarifs;

        return $this;
    }
}
