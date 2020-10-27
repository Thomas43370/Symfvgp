<?php

namespace App\Entity;

use App\Entity\LesvgpCategorie;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\LesvgpRegleRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=LesvgpRegleRepository::class)
 * @UniqueEntity("Regle")
 */
class LesvgpRegle
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
    private $Regle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commentaire_Regle;

    /**
     * @ORM\OneToMany(targetEntity=LesvgpCategorie::class, mappedBy="Regle")
     */
    private $lesvgpCategories;

    /**
     * @ORM\OneToMany(targetEntity=LesvgpQuestion::class, mappedBy="Regle")
     */
    private $lesvgpQuestions;

    /**
     * @ORM\OneToMany(targetEntity=LesvgpFormulaire::class, mappedBy="Regle")
     */
    private $lesvgpFormulaires;

    public function __construct()
    {
        $this->lesvgpCategories = new ArrayCollection();
        $this->lesvgpQuestions = new ArrayCollection();
        $this->lesvgpFormulaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegle(): ?string
    {
        return $this->Regle;
    }

    public function setRegle(string $Regle): self
    {
        $this->Regle = $Regle;

        return $this;
    }

    public function getCommentaireRegle(): ?string
    {
        return $this->commentaire_Regle;
    }

    public function setCommentaireRegle(?string $commentaire_Regle): self
    {
        $this->commentaire_Regle = $commentaire_Regle;

        return $this;
    }

    /**
     * @return Collection|LesvgpCategorie[]
     */
    public function getLesvgpCategories(): Collection
    {
        return $this->lesvgpCategories;
    }

    public function addLesvgpCategory(LesvgpCategorie $lesvgpCategory): self
    {
        if (!$this->lesvgpCategories->contains($lesvgpCategory)) {
            $this->lesvgpCategories[] = $lesvgpCategory;
            $lesvgpCategory->setRegle($this);
        }

        return $this;
    }

    public function removeLesvgpCategory(LesvgpCategorie $lesvgpCategory): self
    {
        if ($this->lesvgpCategories->removeElement($lesvgpCategory)) {
            // set the owning side to null (unless already changed)
            if ($lesvgpCategory->getRegle() === $this) {
                $lesvgpCategory->setRegle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|LesvgpQuestion[]
     */
    public function getLesvgpQuestions(): Collection
    {
        return $this->lesvgpQuestions;
    }

    public function addLesvgpQuestion(LesvgpQuestion $lesvgpQuestion): self
    {
        if (!$this->lesvgpQuestions->contains($lesvgpQuestion)) {
            $this->lesvgpQuestions[] = $lesvgpQuestion;
            $lesvgpQuestion->setRegle($this);
        }

        return $this;
    }

    public function removeLesvgpQuestion(LesvgpQuestion $lesvgpQuestion): self
    {
        if ($this->lesvgpQuestions->removeElement($lesvgpQuestion)) {
            // set the owning side to null (unless already changed)
            if ($lesvgpQuestion->getRegle() === $this) {
                $lesvgpQuestion->setRegle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|LesvgpFormulaire[]
     */
    public function getLesvgpFormulaires(): Collection
    {
        return $this->lesvgpFormulaires;
    }

    public function addLesvgpFormulaire(LesvgpFormulaire $lesvgpFormulaire): self
    {
        if (!$this->lesvgpFormulaires->contains($lesvgpFormulaire)) {
            $this->lesvgpFormulaires[] = $lesvgpFormulaire;
            $lesvgpFormulaire->setRegle($this);
        }

        return $this;
    }

    public function removeLesvgpFormulaire(LesvgpFormulaire $lesvgpFormulaire): self
    {
        if ($this->lesvgpFormulaires->removeElement($lesvgpFormulaire)) {
            // set the owning side to null (unless already changed)
            if ($lesvgpFormulaire->getRegle() === $this) {
                $lesvgpFormulaire->setRegle(null);
            }
        }

        return $this;
    }
}
