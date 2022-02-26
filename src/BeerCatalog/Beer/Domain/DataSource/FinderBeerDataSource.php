<?php

namespace App\BeerCatalog\Beer\Domain\DataSource;

use App\BeerCatalog\Beer\Application\Find\Query\FindBeerByFoodQuery;
use App\BeerCatalog\Beer\Domain\Dto\CatalogBeerDto;

interface FinderBeerDataSource
{
    public function findBeerByFood(FindBeerByFoodQuery $query) : CatalogBeerDto;
}