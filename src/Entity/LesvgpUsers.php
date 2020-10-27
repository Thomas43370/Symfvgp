<?php

namespace App\Entity;

use App\Repository\LesvgpUsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=LesvgpUsersRepository::class)
 * @UniqueEntity("email")
 */
class LesvgpUsers implements UserInterface
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
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(
     *      message = "L'adresse email doit valide, {{ value }} n'est pas une adresse mail complète.")
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *          min=8,
     *          minMessage="Votre mot de passe doit avoir {{limit}} caractères minimum",
     * )
     */
    private $password;
   
    /**
     *  @Assert\EqualTo(propertyPath="password", message="pas le meme mot de passe")
     */
    public $confirm_password;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $roles;

    /**
     * @ORM\OneToMany(targetEntity=LesvgpClients::class, mappedBy="User")
     */
    private $lesvgpClients;

    /**
     * @ORM\OneToMany(targetEntity=LesvgpVgp::class, mappedBy="USer")
     */
    private $lesvgpVgps;

    public function __construct()
    {
        $this->lesvgpClients = new ArrayCollection();
        $this->lesvgpVgps = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles()
    {
        return ["ROLE_ADMIN"];
        return $this->roles;
    }

    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    public function eraseCredentials(){}

    public function getSalt(){}

    /**
     * @return Collection|LesvgpClients[]
     */
    public function getLesvgpClients(): Collection
    {
        return $this->lesvgpClients;
    }

    public function addLesvgpClient(LesvgpClients $lesvgpClient): self
    {
        if (!$this->lesvgpClients->contains($lesvgpClient)) {
            $this->lesvgpClients[] = $lesvgpClient;
            $lesvgpClient->setUser($this);
        }

        return $this;
    }

    public function removeLesvgpClient(LesvgpClients $lesvgpClient): self
    {
        if ($this->lesvgpClients->removeElement($lesvgpClient)) {
            // set the owning side to null (unless already changed)
            if ($lesvgpClient->getUser() === $this) {
                $lesvgpClient->setUser(null);
            }
        }

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
            $lesvgpVgp->setUSer($this);
        }

        return $this;
    }

    public function removeLesvgpVgp(LesvgpVgp $lesvgpVgp): self
    {
        if ($this->lesvgpVgps->removeElement($lesvgpVgp)) {
            // set the owning side to null (unless already changed)
            if ($lesvgpVgp->getUSer() === $this) {
                $lesvgpVgp->setUSer(null);
            }
        }

        return $this;
    }

}
