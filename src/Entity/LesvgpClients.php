<?php

namespace App\Entity;

use App\Repository\LesvgpClientsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LesvgpClientsRepository::class)
 */
class LesvgpClients
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
    private $Societe;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Adresse;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Code_Postal;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Ville;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity=LesvgpMatcli::class, mappedBy="Clients")
     */
    private $lesvgpMatclis;

    /**
     * @ORM\ManyToOne(targetEntity=lesvgpUsers::class, inversedBy="lesvgpClients")
     */
    private $User;

    public function __construct()
    {
        $this->lesvgpMatclis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSociete(): ?string
    {
        return $this->Societe;
    }

    public function setSociete(string $Societe): self
    {
        $this->Societe = $Societe;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(?string $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getCodePostal(): ?int
    {
        return $this->Code_Postal;
    }

    public function setCodePostal(?int $Code_Postal): self
    {
        $this->Code_Postal = $Code_Postal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->Ville;
    }

    public function setVille(?string $Ville): self
    {
        $this->Ville = $Ville;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

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
            $lesvgpMatcli->setClients($this);
        }

        return $this;
    }

    public function removeLesvgpMatcli(LesvgpMatcli $lesvgpMatcli): self
    {
        if ($this->lesvgpMatclis->removeElement($lesvgpMatcli)) {
            // set the owning side to null (unless already changed)
            if ($lesvgpMatcli->getClients() === $this) {
                $lesvgpMatcli->setClients(null);
            }
        }

        return $this;
    }

    public function getUser(): ?lesvgpUsers
    {
        return $this->User;
    }

    public function setUser(?lesvgpUsers $User): self
    {
        $this->User = $User;

        return $this;
    }
}
