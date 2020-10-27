<?php

namespace App\Entity;

use App\Repository\LesvgpMarqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LesvgpMarqueRepository::class)
 */
class LesvgpMarque
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
    private $Marque;

    /**
     * @ORM\OneToMany(targetEntity=LesvgpModele::class, mappedBy="Marque")
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

    public function getMarque(): ?string
    {
        return $this->Marque;
    }

    public function setMarque(string $Marque): self
    {
        $this->Marque = $Marque;

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
            $lesvgpModele->setMarque($this);
        }

        return $this;
    }

    public function removeLesvgpModele(LesvgpModele $lesvgpModele): self
    {
        if ($this->lesvgpModeles->removeElement($lesvgpModele)) {
            // set the owning side to null (unless already changed)
            if ($lesvgpModele->getMarque() === $this) {
                $lesvgpModele->setMarque(null);
            }
        }

        return $this;
    }
}
