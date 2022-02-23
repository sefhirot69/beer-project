<?php

namespace BeerCatalog\Shared\Infrastructure;

use BeerCatalog\Shared\Domain\HttpClientRepository;
use GuzzleHttp\ClientInterface;

final class GuzzleHttpClientRepository implements HttpClientRepository
{

    /**
     * @var ClientInterface
     */
    private $client;

    public function __construct(ClientInterface $client)
    {

        $this->client = $client;
    }

    /**
     * @inheritDoc
     */
    public function fetch(string $method, string $endpoint, array $query): array
    {
        //TODO desarrollar contenido
        return[];
    }

}