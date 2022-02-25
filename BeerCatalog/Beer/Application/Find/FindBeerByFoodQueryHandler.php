<?php

declare(strict_types=1);


namespace BeerCatalog\Beer\Application\Find;

use BeerCatalog\Beer\Application\Find\Query\FindBeerByFoodQuery;
use BeerCatalog\Beer\Domain\DataSource\FinderBeerDataSource;
use BeerCatalog\Beer\Domain\Dto\CatalogBeerDto;

final class FindBeerByFoodQueryHandler
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