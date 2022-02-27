<?php

namespace App\BeerCatalog\Beer\Domain\DataSource;

use App\BeerCatalog\Beer\Application\Find\Query\FindBeerByFoodQuery;
use App\BeerCatalog\Beer\Domain\Dto\CatalogBeerDto;
use App\BeerCatalog\Beer\Domain\Exceptions\BeersNotFoundException;
use App\BeerCatalog\Shared\Domain\Exceptions\HttpClientException;

interface FinderBeerDataSource
{
    /**
     * @throws BeersNotFoundException|HttpClientException
     */
    public function findBeerByFood(FindBeerByFoodQuery $query): CatalogBeerDto;
}
