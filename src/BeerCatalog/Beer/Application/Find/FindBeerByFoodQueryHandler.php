<?php

declare(strict_types=1);


namespace App\BeerCatalog\Beer\Application\Find;

use App\BeerCatalog\Beer\Application\Find\Query\FindBeerByFoodQuery;
use App\BeerCatalog\Beer\Domain\DataSource\FinderBeerDataSource;
use App\BeerCatalog\Beer\Domain\Dto\CatalogBeerDto;

class FindBeerByFoodQueryHandler
{

    private FinderBeerDataSource $finderBeerDataSource;

    /**
     * @param FinderBeerDataSource $finderBeerDataSource
     */
    public function __construct(FinderBeerDataSource $finderBeerDataSource)
    {
        $this->finderBeerDataSource = $finderBeerDataSource;
    }

    public function __invoke(FindBeerByFoodQuery $query): CatalogBeerDto
    {
        return $this->finderBeerDataSource->findBeerByFood($query);
    }
}