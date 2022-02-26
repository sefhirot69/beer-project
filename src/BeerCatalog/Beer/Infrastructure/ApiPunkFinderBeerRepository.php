<?php

declare(strict_types=1);


namespace App\BeerCatalog\Beer\Infrastructure;

use App\BeerCatalog\Beer\Application\Find\Query\FindBeerByFoodQuery;
use App\BeerCatalog\Beer\Domain\Beer;
use App\BeerCatalog\Beer\Domain\BeerDetails;
use App\BeerCatalog\Beer\Domain\CatalogBeer;
use App\BeerCatalog\Beer\Domain\DataSource\FinderBeerDataSource;
use App\BeerCatalog\Beer\Domain\Dto\CatalogBeerDto;
use App\BeerCatalog\Shared\Domain\Exceptions\HttpClientException;
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
     * @param FindBeerByFoodQuery $query
     * @return CatalogBeerDto
     * @throws HttpClientException
     */
    public function findBeerByFood(FindBeerByFoodQuery $query): CatalogBeerDto
    {
        $endpoint = $this->baseUrlApiPunk . self::ENDPOINT;
        $resultBeers = $this->httpClientDataSource->fetch(
            'GET',
            $endpoint,
            [
                'food' => '_' . $query->getFoodFilter()
            ]
        );

        if (empty($resultBeers)) {
            throw new \RuntimeException('Not Found');
        }

        return CatalogBeer::create($this->buildBeers($resultBeers, $query->isWithDetail()))->mapToDto();
    }

    /**
     * @param array $resultBeers
     * @param bool $withDetails
     * @return array|Beer[]
     */
    private function buildBeers(array $resultBeers, bool $withDetails): array
    {
        //Con detalles
        if ($withDetails) {
            return array_map(static function ($beer) {
                return Beer::create(
                    $beer['id'],
                    $beer['name'],
                    $beer['description'],
                    BeerDetails::create($beer['image_url'], $beer['tagline'], $beer['first_brewed']),
                );
            }, $resultBeers);
        }

        //Sin detalles
        return array_map(static function ($beer) {
            return Beer::create($beer['id'], $beer['name'], $beer['description']);
        }, $resultBeers);
    }
}