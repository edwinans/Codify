<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints\Email;
/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields="email", message="Email deja utilisé")
 * @UniqueEntity(fields="username", message="Pseudo deja utilisé")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="8",minMessage="Votre mot de passe doit fire minimum 8 characteres")
     * @Assert\EqualTo(propertyPath="confirm_password",message="Mots de passe differents")
     */
    private $password;

    /** 
     * @Assert\EqualTo(propertyPath="password",message="Mots de passe differents")
     */
    private $confirm_password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @var array
     * 
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\OneToMany(targetEntity=Exercice::class, mappedBy="author")
     */
    private $exericesCreated;

    /**
     * @ORM\OneToMany(targetEntity=Resolution::class, mappedBy="user")
     */
    private $resolutions;

    public function __construct()
    {
        $this->roles[]='ROLE_ETUDIANT';
        $this->exericesCreated = new ArrayCollection();
        $this->resolutions = new ArrayCollection();
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getConfirmPassword(): ?string
    {
        return $this->confirm_password;
    }

    public function setConfirmPassword(string $confirm_password): self
    {
        $this->confirm_password = $confirm_password;

        return $this;
    }

    public function getSalt(){
        return null;
    }

    public function eraseCredentials(){
        
    }

    public function serialize(){
        return serialize([
               $this->id,
               $this->username,
               $this->password
        ]);
    }

    public function unserialize($serialized){
        list (
            $this->id,
            $this->username,
            $this->password
        )= unserialize($serialized);
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

    /**
     * @return array(Role|string)[] the user roles
     */
    public function getRoles():array{
        $tmp_roles=$this->roles;
        if(in_array('ROLE_ETUDIANT',$tmp_roles)=== false){
            $tmp_roles[]='ROLE_ETUDIANT';
        }
        return $tmp_roles;
    
    }
    
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @return Collection|Exercice[]
     */
    public function getExericesCreated(): Collection
    {
        return $this->exericesCreated;
    }

    public function addExericesCreated(Exercice $exericesCreated): self
    {
        if (!$this->exericesCreated->contains($exericesCreated)) {
            $this->exericesCreated[] = $exericesCreated;
            $exericesCreated->setAuthor($this);
        }

        return $this;
    }

    public function removeExericesCreated(Exercice $exericesCreated): self
    {
        if ($this->exericesCreated->contains($exericesCreated)) {
            $this->exericesCreated->removeElement($exericesCreated);
            // set the owning side to null (unless already changed)
            if ($exericesCreated->getAuthor() === $this) {
                $exericesCreated->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Resolution[]
     */
    public function getResolutions(): Collection
    {
        return $this->resolutions;
    }

    public function addResolution(Resolution $resolution): self
    {
        if (!$this->resolutions->contains($resolution)) {
            $this->resolutions[] = $resolution;
            $resolution->setUser($this);
        }

        return $this;
    }

    public function removeResolution(Resolution $resolution): self
    {
        if ($this->resolutions->contains($resolution)) {
            $this->resolutions->removeElement($resolution);
            // set the owning side to null (unless already changed)
            if ($resolution->getUser() === $this) {
                $resolution->setUser(null);
            }
        }

        return $this;
    }
}
