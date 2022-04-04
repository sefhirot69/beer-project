<?php

declare(strict_types=1);

namespace App\BeerCatalog\Beer\Infrastructure;

use App\BeerCatalog\Beer\Domain\DataSource\GetBeerDataSource;
use App\BeerCatalog\Beer\Domain\Dto\BeerDto;
use App\BeerCatalog\Beer\Domain\Exceptions\BeersNotFoundException;
use App\BeerCatalog\Shared\Domain\Exceptions\HttpClientException;
use App\BeerCatalog\Shared\Domain\HttpClientDataSource;

final class ApiPunkGetBeerRepository implements GetBeerDataSource
{
    private const ENDPOINT = 'beers/random';

    public function __construct(private HttpClientDataSource $dataSource)
    {
    }

    /**
     * @throws HttpClientException
     * @throws BeersNotFoundException
     */
    public function get(): BeerDto
    {
        $result = $this->dataSource->fetch('GET', self::ENDPOINT, []);

        if (empty($result)) {
            throw new BeersNotFoundException('random');
        }
    }
}
