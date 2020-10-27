<?php

namespace App\Entity;

use App\Repository\LesvgpPropositionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LesvgpPropositionRepository::class)
 */
class LesvgpProposition
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Proposition;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $categ;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Unite_Valeur;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Equipements;

    /**
     * @ORM\ManyToOne(targetEntity=LesvgpCategorie::class, inversedBy="lesvgpPropositions")
     */
    private $Categorie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProposition(): ?string
    {
        return $this->Proposition;
    }

    public function setProposition(string $Proposition): self
    {
        $this->Proposition = $Proposition;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getCateg(): ?string
    {
        return $this->categ;
    }

    public function setCateg(string $categ): self
    {
        $this->categ = $categ;

        return $this;
    }

    public function getUniteValeur(): ?string
    {
        return $this->Unite_Valeur;
    }

    public function setUniteValeur(?string $Unite_Valeur): self
    {
        $this->Unite_Valeur = $Unite_Valeur;

        return $this;
    }

    public function getEquipements(): ?string
    {
        return $this->Equipements;
    }

    public function setEquipements(?string $Equipements): self
    {
        $this->Equipements = $Equipements;

        return $this;
    }

    public function getCategorie(): ?LesvgpCategorie
    {
        return $this->Categorie;
    }

    public function setCategorie(?LesvgpCategorie $Categorie): self
    {
        $this->Categorie = $Categorie;

        return $this;
    }
}
