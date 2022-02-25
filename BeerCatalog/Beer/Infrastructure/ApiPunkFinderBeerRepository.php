<?php

declare(strict_types=1);


namespace BeerCatalog\Beer\Infrastructure;

use BeerCatalog\Beer\Application\Find\Query\FindBeerByFoodQuery;
use BeerCatalog\Beer\Domain\Beer;
use BeerCatalog\Beer\Domain\CatalogBeer;
use BeerCatalog\Beer\Domain\DataSource\FinderBeerDataSource;
use BeerCatalog\Beer\Domain\Dto\CatalogBeerDto;
use BeerCatalog\Shared\Domain\HttpClientDataSource;

final class ApiPunkFinderBeerRepository implements FinderBeerDataSource
{


    private HttpClientDataSource $httpClientDataSource;
    private string $baseUrlApiPunk;

    public function __construct(HttpClientDataSource $httpClientDataSource, string $baseUrlApiPunk)
    {
        $this->httpClientDataSource = $httpClientDataSource;
        $this->baseUrlApiPunk = $baseUrlApiPunk;
    }

    public function findBeerByFood(FindBeerByFoodQuery $query): CatalogBeerDto
    {
        $endpoint = $this->baseUrlApiPunk.'';
        $resultBeers = $this->httpClientDataSource->fetch('GET', 'https://api.punkapi.com/v2/beers?food=_cru', []);

        if (empty($resultBeers)) {
            throw new \RuntimeException('Not Found');
        }

        return CatalogBeer::create(
            array_map(static function ($beer) {
                return Beer::create($beer['id'],$beer['name'],$beer['description']);
            }, $resultBeers)
        )->mapToDto();
    }
}