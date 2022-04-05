<?php

declare(strict_types=1);

namespace App\BeerCatalog\Beer\Infrastructure;

use App\BeerCatalog\Beer\Domain\Beer;
use App\BeerCatalog\Beer\Domain\BeerDetails;
use App\BeerCatalog\Beer\Domain\DataSource\GetBeerDataSource;
use App\BeerCatalog\Beer\Domain\Dto\BeerDto;
use App\BeerCatalog\Beer\Domain\Exceptions\BeersNotFoundException;
use App\BeerCatalog\Shared\Domain\Exceptions\HttpClientException;
use App\BeerCatalog\Shared\Domain\HttpClientDataSource;

final class ApiPunkGetBeerRepository implements GetBeerDataSource
{
    private const ENDPOINT = 'beers/random';

    public function __construct(private HttpClientDataSource $dataSource, private string $baseUrlApiPunk)
    {
    }

    /**
     * @throws HttpClientException
     * @throws BeersNotFoundException
     */
    public function get(): BeerDto
    {
        $endpoint = $this->baseUrlApiPunk.self::ENDPOINT;
        $result = $this->dataSource->fetch('GET', $endpoint, []);

        if (empty($result)) {
            throw new BeersNotFoundException('random');
        }

        return $this->buildBeers($result, false)[0]->mapToDto();
    }

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
