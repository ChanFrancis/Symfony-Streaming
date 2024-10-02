<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\MediaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\InheritanceType;

#[ORM\Entity(repositoryClass: MediaRepository::class)]
#[InheritanceType('JOINED')]
#[DiscriminatorColumn(name: 'discr', type: 'string')]
#[DiscriminatorMap(['serie' => Serie::class, 'movie' => Movie::class])]
class Media
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, PlaylistMedia>
     */
    #[ORM\OneToMany(targetEntity: PlaylistMedia::class, mappedBy: 'media')]
    private Collection $playlistMedia;

    /**
     * @var Collection<int, WatchHistory>
     */
    #[ORM\OneToMany(targetEntity: WatchHistory::class, mappedBy: 'media')]
    private Collection $watchHistory;

    /**
     * @var Collection<int, Category>
     */
    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'categoriesMedia')]
    private Collection $categoriesMedia;

    /**
     * @var Collection<int, Language>
     */
    #[ORM\ManyToMany(targetEntity: Language::class, inversedBy: 'MediaLanguage')]
    private Collection $mediaLanguage;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $shortDescription = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $longDescription = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $releaseDate = null;

    #[ORM\Column(length: 255)]
    private ?string $coverImage = null;

    #[ORM\Column(nullable: true)]
    private ?array $staff = null;

    #[ORM\Column(nullable: true)]
    private ?array $cast = null;

    public function __construct()
    {
        $this->playlistMedia = new ArrayCollection();
        $this->watchHistory = new ArrayCollection();
        $this->categoriesMedia = new ArrayCollection();
        $this->mediaLanguage = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, PlaylistMedia>
     */
    public function getPlaylistMedia(): Collection
    {
        return $this->playlistMedia;
    }

    public function addPlaylistMedium(PlaylistMedia $playlistMedium): static
    {
        if (!$this->playlistMedia->contains($playlistMedium)) {
            $this->playlistMedia->add($playlistMedium);
            $playlistMedium->setMedia($this);
        }

        return $this;
    }

    public function removePlaylistMedium(PlaylistMedia $playlistMedium): static
    {
        if ($this->playlistMedia->removeElement($playlistMedium)) {
            // set the owning side to null (unless already changed)
            if ($playlistMedium->getMedia() === $this) {
                $playlistMedium->setMedia(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, WatchHistory>
     */
    public function getWatchHistory(): Collection
    {
        return $this->watchHistory;
    }

    public function addWatchHistory(WatchHistory $watchHistory): static
    {
        if (!$this->watchHistory->contains($watchHistory)) {
            $this->watchHistory->add($watchHistory);
            $watchHistory->setMedia($this);
        }

        return $this;
    }

    public function removeWatchHistory(WatchHistory $watchHistory): static
    {
        if ($this->watchHistory->removeElement($watchHistory)) {
            // set the owning side to null (unless already changed)
            if ($watchHistory->getMedia() === $this) {
                $watchHistory->setMedia(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategoriesMedia(): Collection
    {
        return $this->categoriesMedia;
    }

    public function addCategoriesMedium(Category $categoriesMedium): static
    {
        if (!$this->categoriesMedia->contains($categoriesMedium)) {
            $this->categoriesMedia->add($categoriesMedium);
        }

        return $this;
    }

    public function removeCategoriesMedium(Category $categoriesMedium): static
    {
        $this->categoriesMedia->removeElement($categoriesMedium);

        return $this;
    }

    /**
     * @return Collection<int, Language>
     */
    public function getMediaLanguage(): Collection
    {
        return $this->mediaLanguage;
    }

    public function addMediaLanguage(Language $mediaLanguage): static
    {
        if (!$this->mediaLanguage->contains($mediaLanguage)) {
            $this->mediaLanguage->add($mediaLanguage);
        }

        return $this;
    }

    public function removeMediaLanguage(Language $mediaLanguage): static
    {
        $this->mediaLanguage->removeElement($mediaLanguage);

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(string $shortDescription): static
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    public function getLongDescription(): ?string
    {
        return $this->longDescription;
    }

    public function setLongDescription(string $longDescription): static
    {
        $this->longDescription = $longDescription;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(\DateTimeInterface $releaseDate): static
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getCoverImage(): ?string
    {
        return $this->coverImage;
    }

    public function setCoverImage(string $coverImage): static
    {
        $this->coverImage = $coverImage;

        return $this;
    }

    public function getStaff(): ?array
    {
        return $this->staff;
    }

    public function setStaff(?array $staff): static
    {
        $this->staff = $staff;

        return $this;
    }

    public function getCast(): ?array
    {
        return $this->cast;
    }

    public function setCast(?array $cast): static
    {
        $this->cast = $cast;

        return $this;
    }
}
