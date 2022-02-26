<?php

namespace App\BeerCatalog\Shared\Domain;

use App\BeerCatalog\Shared\Domain\Exceptions\HttpClientException;

interface HttpClientDataSource
{
    /**
     * @param string $method
     * @param string $endpoint
     * @param array  $query
     *
     * @throws HttpClientException
     * @return array
     */
    public function fetch(string $method, string $endpoint, array $query) : array;
}