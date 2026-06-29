<?php

namespace App\Entity;

use App\Repository\OuvrierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OuvrierRepository::class)]
class Ouvrier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $role = null;

    #[ORM\OneToMany(targetEntity: DemandeDevis::class, mappedBy: 'ouvrier')]
    private Collection $demandesDevis;

    public function __construct()
    {
        $this->demandesDevis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;
        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;
        return $this;
    }

    public function getDemandesDevis(): Collection
    {
        return $this->demandesDevis;
    }

    public function addDemandeDevi(DemandeDevis $demandeDevi): static
    {
        if (!$this->demandesDevis->contains($demandeDevi)) {
            $this->demandesDevis->add($demandeDevi);
            $demandeDevi->setOuvrier($this);
        }
        return $this;
    }

    public function removeDemandeDevi(DemandeDevis $demandeDevi): static
    {
        if ($this->demandesDevis->removeElement($demandeDevi)) {
            if ($demandeDevi->getOuvrier() === $this) {
                $demandeDevi->setOuvrier(null);
            }
        }
        return $this;
    }
}