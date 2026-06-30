<?php

namespace App\Entity;

use App\Repository\PrestationRepository;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PrestationRepository::class)]
#[ApiResource(
    uriTemplate: '/prestation',
    normalizationContext: ['groups' => ['prestation:read']]
)]
class Prestation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['prestation:read', 'oeuvre:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['prestation:read', 'oeuvre:read'])]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['prestation:read'])]
    private ?string $contenuDetaille = null;

    #[ORM\OneToMany(targetEntity: Oeuvre::class, mappedBy: 'prestation')]
    #[Groups(['prestation:read'])] 
    private Collection $oeuvres;

    #[ORM\OneToMany(targetEntity: DemandeDevis::class, mappedBy: 'prestation')]
    private Collection $demandesDevis;

    public function __construct()
    {
        $this->oeuvres = new ArrayCollection();
        $this->demandesDevis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;
        return $this;
    }

    public function getContenuDetaille(): ?string
    {
        return $this->contenuDetaille;
    }

    public function setContenuDetaille(string $contenuDetaille): static
    {
        $this->contenuDetaille = $contenuDetaille;
        return $this;
    }

    /**
     * @return Collection<int, Oeuvre>
     */
    public function getOeuvres(): Collection
    {
        return $this->oeuvres;
    }

    public function addOeuvre(Oeuvre $oeuvre): static
    {
        if (!$this->oeuvres->contains($oeuvre)) {
            $this->oeuvres->add($oeuvre);
            $oeuvre->setPrestation($this);
        }
        return $this;
    }

    public function removeOeuvre(Oeuvre $oeuvre): static
    {
        if ($this->oeuvres->removeElement($oeuvre)) {
            if ($oeuvre->getPrestation() === $this) {
                $oeuvre->setPrestation(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection<int, DemandeDevis>
     */
    public function getDemandesDevis(): Collection
    {
        return $this->demandesDevis;
    }

    public function addDemandeDevi(DemandeDevis $demandeDevi): static
    {
        if (!$this->demandesDevis->contains($demandeDevi)) {
            $this->demandesDevis->add($demandeDevi);
            $demandeDevi->setPrestation($this);
        }
        return $this;
    }
public function removeDemandeDevi(DemandeDevis $demandeDevi): static
{
    if ($this->demandesDevis->removeElement($demandeDevi)) {
        if ($demandeDevi->getPrestation() === $this) {
            $demandeDevi->setPrestation(null);
        }
    }

    return $this;
}

public function __toString(): string
{
    return $this->titre ?? 'Prestation';
}
}