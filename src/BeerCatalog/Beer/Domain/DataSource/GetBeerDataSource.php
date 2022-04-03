<?php

declare(strict_types=1);

namespace App\BeerCatalog\Beer\Domain\DataSource;

use App\BeerCatalog\Beer\Domain\Dto\BeerDto;

interface GetBeerDataSource
{
    public function get(): BeerDto;
}
