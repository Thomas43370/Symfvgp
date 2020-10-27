<?php

namespace App\Entity;

use App\Repository\LesvgpQuestionnaireRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LesvgpQuestionnaireRepository::class)
 */
class LesvgpQuestionnaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=LesvgpFormulaire::class, cascade={"persist", "remove"})
     */
    private $Formulaire;

    /**
     * @ORM\Column(type="text")
     */
    private $Donnees;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFormulaire(): ?LesvgpFormulaire
    {
        return $this->Formulaire;
    }

    public function setFormulaire(?LesvgpFormulaire $Formulaire): self
    {
        $this->Formulaire = $Formulaire;

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
}
