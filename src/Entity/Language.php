<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\LanguageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LanguageRepository::class)]
class Language
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 3)]
    private ?string $code = null;

    /**
     * @var Collection<int, Media>
     */
    #[ORM\ManyToMany(targetEntity: Media::class, mappedBy: 'mediaLanguage')]
    private Collection $MediaLanguage;

    public function __construct()
    {
        $this->MediaLanguage = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return Collection<int, Media>
     */
    public function getMediaLanguage(): Collection
    {
        return $this->MediaLanguage;
    }

    public function addMediaLanguage(Media $mediaLanguage): static
    {
        if (!$this->MediaLanguage->contains($mediaLanguage)) {
            $this->MediaLanguage->add($mediaLanguage);
            $mediaLanguage->addMediaLanguage($this);
        }

        return $this;
    }

    public function removeMediaLanguage(Media $mediaLanguage): static
    {
        if ($this->MediaLanguage->removeElement($mediaLanguage)) {
            $mediaLanguage->removeMediaLanguage($this);
        }

        return $this;
    }
}
