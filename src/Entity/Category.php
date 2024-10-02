<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    /**
     * @var Collection<int, Media>
     */
    #[ORM\ManyToMany(targetEntity: Media::class, mappedBy: 'categoriesMedia')]
    private Collection $categoriesMedia;

    public function __construct()
    {
        $this->categoriesMedia = new ArrayCollection();
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

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection<int, Media>
     */
    public function getCategoriesMedia(): Collection
    {
        return $this->categoriesMedia;
    }

    public function addCategoriesMedium(Media $categoriesMedium): static
    {
        if (!$this->categoriesMedia->contains($categoriesMedium)) {
            $this->categoriesMedia->add($categoriesMedium);
            $categoriesMedium->addCategoriesMedium($this);
        }

        return $this;
    }

    public function removeCategoriesMedium(Media $categoriesMedium): static
    {
        if ($this->categoriesMedia->removeElement($categoriesMedium)) {
            $categoriesMedium->removeCategoriesMedium($this);
        }

        return $this;
    }
}
