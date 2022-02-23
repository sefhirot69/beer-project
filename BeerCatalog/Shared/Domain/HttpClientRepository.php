<?php

namespace BeerCatalog\Shared\Domain;

use BeerCatalog\Shared\Domain\Exceptions\HttpClientException;

interface HttpClientRepository
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