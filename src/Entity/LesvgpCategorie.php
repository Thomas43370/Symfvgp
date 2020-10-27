<?php

namespace App\Entity;

use App\Repository\LesvgpCategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LesvgpCategorieRepository::class)
 */
class LesvgpCategorie
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
    private $Categorie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commentaire_Categorie;

    /**
     * @ORM\ManyToOne(targetEntity=LesvgpRegle::class, inversedBy="lesvgpCategories")
     */
    private $Regle;

    /**
     * @ORM\OneToMany(targetEntity=LesvgpMatcli::class, mappedBy="LesvgpCategorie")
     */
    private $lesvgpMatclis;

    /**
     * @ORM\OneToMany(targetEntity=LesvgpProposition::class, mappedBy="Categorie")
     */
    private $lesvgpPropositions;

    public function __construct()
    {
        $this->lesvgpMatclis = new ArrayCollection();
        $this->lesvgpPropositions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategorie(): ?string
    {
        return $this->Categorie;
    }

    public function setCategorie(string $Categorie): self
    {
        $this->Categorie = $Categorie;

        return $this;
    }

    public function getCommentaireCategorie(): ?string
    {
        return $this->commentaire_Categorie;
    }

    public function setCommentaireCategorie(?string $commentaire_Categorie): self
    {
        $this->commentaire_Categorie = $commentaire_Categorie;

        return $this;
    }

    public function getRegle(): ?LesvgpRegle
    {
        return $this->Regle;
    }

    public function setRegle(?LesvgpRegle $Regle): self
    {
        $this->Regle = $Regle;

        return $this;
    }

    /**
     * @return Collection|LesvgpMatcli[]
     */
    public function getLesvgpMatclis(): Collection
    {
        return $this->lesvgpMatclis;
    }

    public function addLesvgpMatcli(LesvgpMatcli $lesvgpMatcli): self
    {
        if (!$this->lesvgpMatclis->contains($lesvgpMatcli)) {
            $this->lesvgpMatclis[] = $lesvgpMatcli;
            $lesvgpMatcli->setLesvgpCategorie($this);
        }

        return $this;
    }

    public function removeLesvgpMatcli(LesvgpMatcli $lesvgpMatcli): self
    {
        if ($this->lesvgpMatclis->removeElement($lesvgpMatcli)) {
            // set the owning side to null (unless already changed)
            if ($lesvgpMatcli->getLesvgpCategorie() === $this) {
                $lesvgpMatcli->setLesvgpCategorie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|LesvgpProposition[]
     */
    public function getLesvgpPropositions(): Collection
    {
        return $this->lesvgpPropositions;
    }

    public function addLesvgpProposition(LesvgpProposition $lesvgpProposition): self
    {
        if (!$this->lesvgpPropositions->contains($lesvgpProposition)) {
            $this->lesvgpPropositions[] = $lesvgpProposition;
            $lesvgpProposition->setCategorie($this);
        }

        return $this;
    }

    public function removeLesvgpProposition(LesvgpProposition $lesvgpProposition): self
    {
        if ($this->lesvgpPropositions->removeElement($lesvgpProposition)) {
            // set the owning side to null (unless already changed)
            if ($lesvgpProposition->getCategorie() === $this) {
                $lesvgpProposition->setCategorie(null);
            }
        }

        return $this;
    }
}
