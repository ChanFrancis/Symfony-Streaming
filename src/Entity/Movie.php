<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Movie extends Media
{
 
}
