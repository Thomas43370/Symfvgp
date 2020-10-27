<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\LesvgpTitreRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=LesvgpTitreRepository::class)
 * @UniqueEntity("Titre")
 */
class LesvgpTitre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @ORM\OrderBy({"order" = "DESC", "Titre" = "DESC"})
     */
    private $Titre;

    /**
     * @ORM\OneToMany(targetEntity=LesvgpQuestion::class, mappedBy="Titre")
     */
    private $lesvgpQuestions;

    public function __construct()
    {
        $this->lesvgpQuestions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): self
    {
        $this->Titre = $Titre;

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
            $lesvgpQuestion->setTitre($this);
        }

        return $this;
    }

    public function removeLesvgpQuestion(LesvgpQuestion $lesvgpQuestion): self
    {
        if ($this->lesvgpQuestions->removeElement($lesvgpQuestion)) {
            // set the owning side to null (unless already changed)
            if ($lesvgpQuestion->getTitre() === $this) {
                $lesvgpQuestion->setTitre(null);
            }
        }

        return $this;
    }
}
