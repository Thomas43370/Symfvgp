<?php

namespace App\Entity;

use App\Repository\LesvgpModeleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LesvgpModeleRepository::class)
 */
class LesvgpModele
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
    private $Modele;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commentaire_Modele;

    /**
     * @ORM\ManyToOne(targetEntity=LesvgpMarque::class, inversedBy="lesvgpModeles")
     */
    private $Marque;

    /**
     * @ORM\ManyToOne(targetEntity=LesvgpEnergie::class, inversedBy="lesvgpModeles")
     */
    private $Energie;

    /**
     * @ORM\OneToMany(targetEntity=LesvgpMatcli::class, mappedBy="LesvgpModele")
     */
    private $lesvgpMatclis;

    public function __construct()
    {
        $this->lesvgpMatclis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModele(): ?string
    {
        return $this->Modele;
    }

    public function setModele(string $Modele): self
    {
        $this->Modele = $Modele;

        return $this;
    }

    public function getCommentaireModele(): ?string
    {
        return $this->commentaire_Modele;
    }

    public function setCommentaireModele(?string $commentaire_Modele): self
    {
        $this->commentaire_Modele = $commentaire_Modele;

        return $this;
    }

    public function getMarque(): ?LesvgpMarque
    {
        return $this->Marque;
    }

    public function setMarque(?LesvgpMarque $Marque): self
    {
        $this->Marque = $Marque;

        return $this;
    }

    public function getEnergie(): ?LesvgpEnergie
    {
        return $this->Energie;
    }

    public function setEnergie(?LesvgpEnergie $Energie): self
    {
        $this->Energie = $Energie;

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
            $lesvgpMatcli->setLesvgpModele($this);
        }

        return $this;
    }

    public function removeLesvgpMatcli(LesvgpMatcli $lesvgpMatcli): self
    {
        if ($this->lesvgpMatclis->removeElement($lesvgpMatcli)) {
            // set the owning side to null (unless already changed)
            if ($lesvgpMatcli->getLesvgpModele() === $this) {
                $lesvgpMatcli->setLesvgpModele(null);
            }
        }

        return $this;
    }
}
