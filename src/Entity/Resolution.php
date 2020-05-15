<?php

namespace App\Entity;

use App\Repository\ResolutionRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ResolutionRepository::class)
 */
class Resolution
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Exercice::class, inversedBy="resolutions")
     */
    private $exercice;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="resolutions")
     */
    private $user;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tentatives;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastTry_at;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_resolved;

    public function __construct()
    {
        $this->tentatives=0;
        $this->is_resolved=false;
        $this->lastTry_at=new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExercice(): ?Exercice
    {
        return $this->exercice;
    }

    public function setExercice(?Exercice $exercice): self
    {
        $this->exercice = $exercice;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getTentatives(): ?int
    {
        return $this->tentatives;
    }

    public function setTentatives(?int $tentatives): self
    {
        $this->tentatives = $tentatives;

        return $this;
    }

    public function getLastTryAt(): ?\DateTimeInterface
    {
        return $this->lastTry_at;
    }

    public function setLastTryAt(?\DateTimeInterface $lastTry_at): self
    {
        $this->lastTry_at = $lastTry_at;

        return $this;
    }

    public function getIsResolved(): ?bool
    {
        return $this->is_resolved;
    }

    public function setIsResolved(?bool $is_resolved): self
    {
        $this->is_resolved = $is_resolved;

        return $this;
    }
}
