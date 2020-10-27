<?php

namespace App\Entity;

use App\Repository\LesvgpQuestionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LesvgpQuestionRepository::class)
 */
class LesvgpQuestion
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
    private $Question;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Verif;

    /**
     * @ORM\ManyToOne(targetEntity=LesvgpTitre::class, inversedBy="lesvgpQuestions")
     */
    private $Titre;

    /**
     * @ORM\ManyToOne(targetEntity=LesvgpRegle::class, inversedBy="lesvgpQuestions")
     */
    private $Regle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->Question;
    }

    public function setQuestion(string $Question): self
    {
        $this->Question = $Question;

        return $this;
    }

    public function getVerif(): ?string
    {
        return $this->Verif;
    }

    public function setVerif(string $Verif): self
    {
        $this->Verif = $Verif;

        return $this;
    }

    public function getTitre(): ?LesvgpTitre
    {
        return $this->Titre;
    }

    public function setTitre(?LesvgpTitre $Titre): self
    {
        $this->Titre = $Titre;

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
