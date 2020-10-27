<?php

namespace App\Entity;

use App\Repository\LesvgpFormulaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LesvgpFormulaireRepository::class)
 */
class LesvgpFormulaire
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
    private $Nom;

    /**
     * @ORM\Column(type="text")
     */
    private $Donnees;

    /**
     * @ORM\Column(type="integer")
     */
    private $Duree;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Levage;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Questionnaire;

    /**
     * @ORM\OneToMany(targetEntity=LesvgpVgp::class, mappedBy="Formulaire")
     */
    private $lesvgpVgps;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commentaire_Formulaire;

    /**
     * @ORM\ManyToOne(targetEntity=LesvgpRegle::class, inversedBy="lesvgpFormulaires")
     */
    private $Regle;

    public function __construct()
    {
        $this->lesvgpVgps = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getDonnees(): ?string
    {
        return $this->Donnees;
    }

    public function setDonnees(string $Donnees): self
    {
        $this->Donnees = $Donnees;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->Duree;
    }

    public function setDuree(int $Duree): self
    {
        $this->Duree = $Duree;

        return $this;
    }

    public function getLevage(): ?bool
    {
        return $this->Levage;
    }

    public function setLevage(bool $Levage): self
    {
        $this->Levage = $Levage;

        return $this;
    }

    public function getQuestionnaire(): ?bool
    {
        return $this->Questionnaire;
    }

    public function setQuestionnaire(bool $Questionnaire): self
    {
        $this->Questionnaire = $Questionnaire;

        return $this;
    }

    /**
     * @return Collection|LesvgpVgp[]
     */
    public function getLesvgpVgps(): Collection
    {
        return $this->lesvgpVgps;
    }

    public function addLesvgpVgp(LesvgpVgp $lesvgpVgp): self
    {
        if (!$this->lesvgpVgps->contains($lesvgpVgp)) {
            $this->lesvgpVgps[] = $lesvgpVgp;
            $lesvgpVgp->setFormulaire($this);
        }

        return $this;
    }

    public function removeLesvgpVgp(LesvgpVgp $lesvgpVgp): self
    {
        if ($this->lesvgpVgps->removeElement($lesvgpVgp)) {
            // set the owning side to null (unless already changed)
            if ($lesvgpVgp->getFormulaire() === $this) {
                $lesvgpVgp->setFormulaire(null);
            }
        }

        return $this;
    }

    public function getCommentaireFormulaire(): ?string
    {
        return $this->commentaire_Formulaire;
    }

    public function setCommentaireFormulaire(?string $commentaire_Formulaire): self
    {
        $this->commentaire_Formulaire = $commentaire_Formulaire;

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
}
