<?php

declare(strict_types=1);

namespace App\BeerCatalog\Beer\Application;

use App\BeerCatalog\Beer\Domain\DataSource\GetBeerDataSource;
use App\BeerCatalog\Beer\Domain\Dto\BeerDto;

class GetBeerQueryHandler
{
    public function __construct(private GetBeerDataSource $getBeerDataSource)
    {
    }

    public function __invoke(bool $withDetails = false): BeerDto
    {
        return $this->getBeerDataSource->get($withDetails);
    }
}
