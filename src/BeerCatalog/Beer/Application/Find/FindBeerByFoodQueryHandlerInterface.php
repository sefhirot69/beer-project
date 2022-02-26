<?php

namespace App\BeerCatalog\Beer\Application\Find;

use App\BeerCatalog\Beer\Application\Find\Query\FindBeerByFoodQuery;
use App\BeerCatalog\Beer\Domain\Dto\CatalogBeerDto;

interface FindBeerByFoodQueryHandlerInterface
{
    public function __invoke(FindBeerByFoodQuery $query) : CatalogBeerDto;
}