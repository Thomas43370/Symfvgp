<?php

namespace App\Entity;

use App\Repository\LesvgpVgpRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LesvgpVgpRepository::class)
 */
class LesvgpVgp
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
    private $rapport;

    /**
     * @ORM\Column(type="integer")
     */
    private $dateproconc;

    /**
     * @ORM\Column(type="integer")
     */
    private $relance;

    /**
     * @ORM\Column(type="text")
     */
    private $Donnees;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Tableau;

    /**
     * @ORM\ManyToOne(targetEntity=LesvgpMatcli::class, inversedBy="lesvgpVgps")
     */
    private $Matcli;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $procont;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Avis;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Synthese;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $ResultatEssais;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $texteimg;

    /**
     * @ORM\ManyToOne(targetEntity=LesvgpFormulaire::class, inversedBy="lesvgpVgps")
     */
    private $Formulaire;

    /**
     * @ORM\ManyToOne(targetEntity=LesvgpUsers::class, inversedBy="lesvgpVgps")
     */
    private $User;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Numserie;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Dateverif;

    /**
     * @ORM\OneToMany(targetEntity=LesvgpImagePhoto::class, mappedBy="Vgp")
     */
    private $lesvgpImagePhotos;

    /**
     * @ORM\OneToMany(targetEntity=LesvgpImageDefauts::class, mappedBy="Vgp")
     */
    private $lesvgpImageDefauts;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $resultat_etat;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $resultat_lim;

    public function __construct()
    {
        $this->lesvgpImagePhotos = new ArrayCollection();
        $this->lesvgpImageDefauts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRapport(): ?string
    {
        return $this->rapport;
    }

    public function setRapport(string $rapport): self
    {
        $this->rapport = $rapport;

        return $this;
    }

    public function getDateproconc(): ?int
    {
        return $this->dateproconc;
    }

    public function setDateproconc(int $dateproconc): self
    {
        $this->dateproconc = $dateproconc;

        return $this;
    }

    public function getRelance(): ?int
    {
        return $this->relance;
    }

    public function setRelance(int $relance): self
    {
        $this->relance = $relance;

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

    public function getTableau(): ?string
    {
        return $this->Tableau;
    }

    public function setTableau(string $Tableau): self
    {
        $this->Tableau = $Tableau;

        return $this;
    }

    public function getMatcli(): ?LesvgpMatcli
    {
        return $this->Matcli;
    }

    public function setMatcli(?LesvgpMatcli $Matcli): self
    {
        $this->Matcli = $Matcli;

        return $this;
    }

    public function getProcont(): ?string
    {
        return $this->procont;
    }

    public function setProcont(string $procont): self
    {
        $this->procont = $procont;

        return $this;
    }

    public function getAvis(): ?int
    {
        return $this->Avis;
    }

    public function setAvis(?int $Avis): self
    {
        $this->Avis = $Avis;

        return $this;
    }

    public function getSynthese(): ?int
    {
        return $this->Synthese;
    }

    public function setSynthese(?int $Synthese): self
    {
        $this->Synthese = $Synthese;

        return $this;
    }

    public function getResultatEssais(): ?string
    {
        return $this->ResultatEssais;
    }

    public function setResultatEssais(?string $ResultatEssais): self
    {
        $this->ResultatEssais = $ResultatEssais;

        return $this;
    }

    public function getTexteimg(): ?string
    {
        return $this->texteimg;
    }

    public function setTexteimg(?string $texteimg): self
    {
        $this->texteimg = $texteimg;

        return $this;
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

    public function getUser(): ?LesvgpUsers
    {
        return $this->User;
    }

    public function setUser(?LesvgpUsers $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getNumserie(): ?string
    {
        return $this->Numserie;
    }

    public function setNumserie(string $Numserie): self
    {
        $this->Numserie = $Numserie;

        return $this;
    }

    public function getDateverif(): ?string
    {
        return $this->Dateverif;
    }

    public function setDateverif(string $Dateverif): self
    {
        $this->Dateverif = $Dateverif;

        return $this;
    }

    /**
     * @return Collection|LesvgpImagePhoto[]
     */
    public function getLesvgpImagePhotos(): Collection
    {
        return $this->lesvgpImagePhotos;
    }

    public function addLesvgpImagePhoto(LesvgpImagePhoto $lesvgpImagePhoto): self
    {
        if (!$this->lesvgpImagePhotos->contains($lesvgpImagePhoto)) {
            $this->lesvgpImagePhotos[] = $lesvgpImagePhoto;
            $lesvgpImagePhoto->setVgp($this);
        }

        return $this;
    }

    public function removeLesvgpImagePhoto(LesvgpImagePhoto $lesvgpImagePhoto): self
    {
        if ($this->lesvgpImagePhotos->removeElement($lesvgpImagePhoto)) {
            // set the owning side to null (unless already changed)
            if ($lesvgpImagePhoto->getVgp() === $this) {
                $lesvgpImagePhoto->setVgp(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|LesvgpImageDefauts[]
     */
    public function getLesvgpImageDefauts(): Collection
    {
        return $this->lesvgpImageDefauts;
    }

    public function addLesvgpImageDefaut(LesvgpImageDefauts $lesvgpImageDefaut): self
    {
        if (!$this->lesvgpImageDefauts->contains($lesvgpImageDefaut)) {
            $this->lesvgpImageDefauts[] = $lesvgpImageDefaut;
            $lesvgpImageDefaut->setVgp($this);
        }

        return $this;
    }

    public function removeLesvgpImageDefaut(LesvgpImageDefauts $lesvgpImageDefaut): self
    {
        if ($this->lesvgpImageDefauts->removeElement($lesvgpImageDefaut)) {
            // set the owning side to null (unless already changed)
            if ($lesvgpImageDefaut->getVgp() === $this) {
                $lesvgpImageDefaut->setVgp(null);
            }
        }

        return $this;
    }

    public function getResultatEtat(): ?string
    {
        return $this->resultat_etat;
    }

    public function setResultatEtat(?string $resultat_etat): self
    {
        $this->resultat_etat = $resultat_etat;

        return $this;
    }

    public function getResultatLim(): ?string
    {
        return $this->resultat_lim;
    }

    public function setResultatLim(?string $resultat_lim): self
    {
        $this->resultat_lim = $resultat_lim;

        return $this;
    }
}
