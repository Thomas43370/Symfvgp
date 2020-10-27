<?php

namespace App\Entity;

use App\Repository\LesvgpImagePhotoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LesvgpImagePhotoRepository::class)
 */
class LesvgpImagePhoto
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
     * @ORM\ManyToOne(targetEntity=LesvgpVgp::class, inversedBy="lesvgpImagePhotos")
     */
    private $Vgp;

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

    public function getVgp(): ?LesvgpVgp
    {
        return $this->Vgp;
    }

    public function setVgp(?LesvgpVgp $Vgp): self
    {
        $this->Vgp = $Vgp;

        return $this;
    }
}
