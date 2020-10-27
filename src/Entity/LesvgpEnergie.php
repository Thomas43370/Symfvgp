<?php

namespace App\Entity;

use App\Repository\LesvgpEnergieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LesvgpEnergieRepository::class)
 */
class LesvgpEnergie
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
    private $Energie;

    /**
     * @ORM\OneToMany(targetEntity=LesvgpModele::class, mappedBy="Energie")
     */
    private $lesvgpModeles;

    public function __construct()
    {
        $this->lesvgpModeles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEnergie(): ?string
    {
        return $this->Energie;
    }

    public function setEnergie(string $Energie): self
    {
        $this->Energie = $Energie;

        return $this;
    }

    /**
     * @return Collection|LesvgpModele[]
     */
    public function getLesvgpModeles(): Collection
    {
        return $this->lesvgpModeles;
    }

    public function addLesvgpModele(LesvgpModele $lesvgpModele): self
    {
        if (!$this->lesvgpModeles->contains($lesvgpModele)) {
            $this->lesvgpModeles[] = $lesvgpModele;
            $lesvgpModele->setEnergie($this);
        }

        return $this;
    }

    public function removeLesvgpModele(LesvgpModele $lesvgpModele): self
    {
        if ($this->lesvgpModeles->removeElement($lesvgpModele)) {
            // set the owning side to null (unless already changed)
            if ($lesvgpModele->getEnergie() === $this) {
                $lesvgpModele->setEnergie(null);
            }
        }

        return $this;
    }
}
