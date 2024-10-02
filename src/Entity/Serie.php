<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\SerieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Serie extends Media
{
    #[ORM\ManyToOne(inversedBy: 'serie')]
    private ?Season $season = null;

    public function getSeason(): ?Season
    {
        return $this->season;
    }

    public function setSeason(?Season $season): static
    {
        $this->season = $season;

        return $this;
    }
}
