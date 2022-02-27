<?php

namespace App\BeerCatalog\Shared\Domain;

use App\BeerCatalog\Shared\Domain\Exceptions\HttpClientException;

interface HttpClientDataSource
{
    /**
     * @throws HttpClientException
     */
    public function fetch(string $method, string $endpoint, array $query): array;
}
