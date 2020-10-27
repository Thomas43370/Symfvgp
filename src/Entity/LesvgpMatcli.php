<?php

namespace App\Entity;

use App\Repository\LesvgpMatcliRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LesvgpMatcliRepository::class)
 */
class LesvgpMatcli
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=LesvgpClients::class, inversedBy="lesvgpMatclis")
     */
    private $Clients;

    /**
     * @ORM\ManyToOne(targetEntity=LesvgpCategorie::class, inversedBy="lesvgpMatclis")
     */
    private $LesvgpCategorie;

    /**
     * @ORM\ManyToOne(targetEntity=LesvgpModele::class, inversedBy="lesvgpMatclis")
     */
    private $LesvgpModele;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commentaire_Matcli;

    /**
     * @ORM\OneToMany(targetEntity=LesvgpVgp::class, mappedBy="Matcli")
     */
    private $lesvgpVgps;

    public function __construct()
    {
        $this->lesvgpVgps = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClients(): ?LesvgpClients
    {
        return $this->Clients;
    }

    public function setClients(?LesvgpClients $Clients): self
    {
        $this->Clients = $Clients;

        return $this;
    }

    public function getLesvgpCategorie(): ?LesvgpCategorie
    {
        return $this->LesvgpCategorie;
    }

    public function setLesvgpCategorie(?LesvgpCategorie $LesvgpCategorie): self
    {
        $this->LesvgpCategorie = $LesvgpCategorie;

        return $this;
    }

    public function getLesvgpModele(): ?LesvgpModele
    {
        return $this->LesvgpModele;
    }

    public function setLesvgpModele(?LesvgpModele $LesvgpModele): self
    {
        $this->LesvgpModele = $LesvgpModele;

        return $this;
    }

    public function getCommentaireMatcli(): ?string
    {
        return $this->commentaire_Matcli;
    }

    public function setCommentaireMatcli(?string $commentaire_Matcli): self
    {
        $this->commentaire_Matcli = $commentaire_Matcli;

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
            $lesvgpVgp->setMatcli($this);
        }

        return $this;
    }

    public function removeLesvgpVgp(LesvgpVgp $lesvgpVgp): self
    {
        if ($this->lesvgpVgps->removeElement($lesvgpVgp)) {
            // set the owning side to null (unless already changed)
            if ($lesvgpVgp->getMatcli() === $this) {
                $lesvgpVgp->setMatcli(null);
            }
        }

        return $this;
    }
}
