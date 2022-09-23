<?php

namespace App\Entity;

use App\Repository\CompetenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompetenceRepository::class)]
class Competence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'Examen', targetEntity: Examen::class)]
    private $examens;

    public function __construct()
    {
        $this->examens = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Examen>
     */

    public function getExamens(): Collection
    {
        return $this->examens;
    }

    public function addExamen(Examen $examen): self
    {
        if (!$this->examens->contains($examen)) {
            $this->comments[] = $examen;
            $examen->setCompetence($this);
        }

        return $this;
    }

    public function removeExamen(Examen $examen): self
    {
        if ($this->examens->removeElement($examen)) {
            // set the owning side to null (unless already changed)
            if ($examen->getCompetence() === $this) {
                $examen->setCompetence(null);
            }
        }

        return $this;
    }
}
