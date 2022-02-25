<?php

namespace BeerCatalog\Beer\Domain\DataSource;

use BeerCatalog\Beer\Application\Find\Query\FindBeerByFoodQuery;
use BeerCatalog\Beer\Domain\Dto\CatalogBeerDto;

interface FinderBeerDataSource
{
    public function findBeerByFood(FindBeerByFoodQuery $query) : CatalogBeerDto;
}