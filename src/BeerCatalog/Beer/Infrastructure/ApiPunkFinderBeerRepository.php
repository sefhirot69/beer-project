<?php

declare(strict_types=1);

namespace App\BeerCatalog\Beer\Infrastructure;

use App\BeerCatalog\Beer\Application\Find\Query\FindBeerByFoodQuery;
use App\BeerCatalog\Beer\Domain\CatalogBeer;
use App\BeerCatalog\Beer\Domain\DataSource\FinderBeerDataSource;
use App\BeerCatalog\Beer\Domain\Dto\CatalogBeerDto;
use App\BeerCatalog\Beer\Domain\Exceptions\BeersNotFoundException;
use App\BeerCatalog\Shared\Domain\HttpClientDataSource;

final class ApiPunkFinderBeerRepository implements FinderBeerDataSource
{
    use BeerTrait;

    private const ENDPOINT = 'beers';

    public function __construct(private HttpClientDataSource $httpClientDataSource, private string $baseUrlApiPunk)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function findBeerByFood(FindBeerByFoodQuery $query): CatalogBeerDto
    {
        $endpoint = $this->baseUrlApiPunk.self::ENDPOINT;
        $resultBeers = $this->httpClientDataSource->fetch(
            'GET',
            $endpoint,
            [
                'food' => $query->getFoodFilter().'_',
            ]
        );

        if (empty($resultBeers)) {
            throw new BeersNotFoundException($query->getFoodFilter());
        }

        return CatalogBeer::create($this->buildBeers($resultBeers, $query->isWithDetail()))->mapToDto();
    }
}
