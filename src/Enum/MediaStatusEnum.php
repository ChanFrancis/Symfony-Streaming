<?php

    declare(strict_types=1);

    namespace App\Enum;

    enum MediaStatusEnum: string
    {
        case SERIE = "serie";
        case MOVIE = "movie";
    }