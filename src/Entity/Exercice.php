<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ResolutionRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExerciceRepository")
 * @Vich\Uploadable
 */
class Exercice
{
    public function __construct()
    {
        $this->created_at = new \DateTime();
        $this->comments = new ArrayCollection();
        $this->resolutions = new ArrayCollection();
    }
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5,max=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(min=0,max=5)
     */
    private $difficulte;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="exercices")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="exercice", orphanRemoval=true)
     */
    private $comments;


    /**
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */
    private $filename;


    /**
     * @var File|null
     * @Vich\UploadableField(mapping="exercice_solution",fileNameProperty="filename")
     */
    private $solutionFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="exericesCreated")
     */
    private $author;

    /**
     * @ORM\OneToMany(targetEntity=Resolution::class, mappedBy="exercice")
     */
    private $resolutions;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }
    public function getSlug(): string
    {
        return (new Slugify())->slugify($this->title);
    }
    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDifficulte(): ?int
    {
        return $this->difficulte;
    }

    public function setDifficulte(int $difficulte): self
    {
        $this->difficulte = $difficulte;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setExercice($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getExercice() === $this) {
                $comment->setExercice(null);
            }
        }

        return $this;
    }

    /**
     * @return null|string
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * @param null|string $filename
     * @return Exercice
     */
    public function setFilename(?string $filename): Exercice
    {
        $this->filename = $filename;
        return $this;
    }


    /**
     * @return null|File
     */
    public function getSolutionFile(): ?File
    {
        return $this->solutionFile;
    }

    /**
     * @param null|File $solutionFile
     * @return Exercice
     */
    public function setSolutionFile(?File $solutionFile): Exercice
    {

        $this->solutionFile = $solutionFile;
        if ($this->solutionFile instanceof UploadedFile) {
            $this->updated_at = new \DateTime('now');
        }
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

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
            $resolution->setExercice($this);
        }

        return $this;
    }

    public function removeResolution(Resolution $resolution): self
    {
        if ($this->resolutions->contains($resolution)) {
            $this->resolutions->removeElement($resolution);
            // set the owning side to null (unless already changed)
            if ($resolution->getExercice() === $this) {
                $resolution->setExercice(null);
            }
        }
        return $this;
    }
    /** 
     * @param User $user
     * @return boolean
     */
    public function isResolvedByUser(User $user): bool
    {
        foreach ($this->resolutions as $resolution) {
            if ($resolution->getUser() == $user and $resolution->getIsResolved() == true) {
                return true;
            }
        }
        return false;
    }


    public function getPercentResolved()
    {
        $nb_resolu = 0;
        $nb_participants = 0;
        foreach ($this->resolutions as $resolution) {
            if (!in_array("ROLE_ENSEIGNANT", $resolution->getUser()->getRoles())) {
                if ($resolution->getIsResolved()) {
                    $nb_resolu = $nb_resolu + 1;
                }
                $nb_participants = $nb_participants + 1;
            }
        }
        try {
            $result = ($nb_resolu) * 100 / ($nb_participants);
        } catch (\Exception $e) {
            return " Aucune Participation pour le moment ! ";
        }
        return $result . ' % ';
    }
}
