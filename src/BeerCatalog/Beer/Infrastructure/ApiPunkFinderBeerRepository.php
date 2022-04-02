<?php

declare(strict_types=1);

namespace App\BeerCatalog\Beer\Infrastructure;

use App\BeerCatalog\Beer\Application\Find\Query\FindBeerByFoodQuery;
use App\BeerCatalog\Beer\Domain\Beer;
use App\BeerCatalog\Beer\Domain\BeerDetails;
use App\BeerCatalog\Beer\Domain\CatalogBeer;
use App\BeerCatalog\Beer\Domain\DataSource\FinderBeerDataSource;
use App\BeerCatalog\Beer\Domain\Dto\CatalogBeerDto;
use App\BeerCatalog\Beer\Domain\Exceptions\BeersNotFoundException;
use App\BeerCatalog\Shared\Domain\HttpClientDataSource;

final class ApiPunkFinderBeerRepository implements FinderBeerDataSource
{
    private const ENDPOINT = 'beers';

    private HttpClientDataSource $httpClientDataSource;
    private string $baseUrlApiPunk;

    public function __construct(HttpClientDataSource $httpClientDataSource, string $baseUrlApiPunk)
    {
        $this->httpClientDataSource = $httpClientDataSource;
        $this->baseUrlApiPunk = $baseUrlApiPunk;
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

    /**
     * @return array|Beer[]
     */
    private function buildBeers(array $resultBeers, bool $withDetails): array
    {
        // Con detalles
        if ($withDetails) {
            return array_map(static function ($beer) {
                return Beer::create(
                    $beer['id'],
                    $beer['name'],
                    $beer['description'],
                    BeerDetails::create($beer['tagline'], $beer['first_brewed'], $beer['image_url']),
                );
            }, $resultBeers);
        }

        // Sin detalles
        return array_map(static function ($beer) {
            return Beer::create($beer['id'], $beer['name'], $beer['description']);
        }, $resultBeers);
    }
}
