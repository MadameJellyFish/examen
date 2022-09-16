<?php

namespace App\Entity;

use App\Repository\InscriptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InscriptionRepository::class)]
class Inscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Examen::class, inversedBy: 'inscriptions')]
    private Collection $examen;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'inscriptions')]
    private Collection $user;

    public function __construct()
    {
        $this->examen = new ArrayCollection();
        $this->user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Examen>
     */
    public function getExamen(): Collection
    {
        return $this->examen;
    }

    public function addExaman(Examen $examan): self
    {
        if (!$this->examen->contains($examan)) {
            $this->examen->add($examan);
        }

        return $this;
    }

    public function removeExaman(Examen $examan): self
    {
        $this->examen->removeElement($examan);

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        $this->user->removeElement($user);

        return $this;
    }
}
