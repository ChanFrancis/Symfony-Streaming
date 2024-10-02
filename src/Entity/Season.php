<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\SeasonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeasonRepository::class)]
class Season
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $number = null;

    /**
     * @var Collection<int, Serie>
     */
    #[ORM\OneToMany(targetEntity: Serie::class, mappedBy: 'season')]
    private Collection $serie;

    #[ORM\ManyToOne(inversedBy: 'season')]
    private ?Episode $episode = null;

    public function __construct()
    {
        $this->serie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): static
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return Collection<int, Serie>
     */
    public function getSerie(): Collection
    {
        return $this->serie;
    }

    public function addSerie(Serie $serie): static
    {
        if (!$this->serie->contains($serie)) {
            $this->serie->add($serie);
            $serie->setSeason($this);
        }

        return $this;
    }

    public function removeSerie(Serie $serie): static
    {
        if ($this->serie->removeElement($serie)) {
            // set the owning side to null (unless already changed)
            if ($serie->getSeason() === $this) {
                $serie->setSeason(null);
            }
        }

        return $this;
    }

    public function getEpisode(): ?Episode
    {
        return $this->episode;
    }

    public function setEpisode(?Episode $episode): static
    {
        $this->episode = $episode;

        return $this;
    }
}
