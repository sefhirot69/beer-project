<?php

namespace App\BeerCatalog\Shared\Infrastructure;

use App\BeerCatalog\Shared\Domain\HttpClientDataSource;
use App\BeerCatalog\Shared\Infrastructure\Exceptions\GuzzleHttpClientException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class GuzzleHttpClientRepository implements HttpClientDataSource
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * {@inheritDoc}
     */
    public function fetch(string $method, string $endpoint, array $query): array
    {
        try {
            $options = $this->buildOptions($method, $query);
            $response = $this->client->request($method, $endpoint, $options);
            if (200 !== $response->getStatusCode()) {
                throw new GuzzleHttpClientException('An error has occurred');
            }

            return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (GuzzleException|\Exception $exception) {
            throw new GuzzleHttpClientException($exception->getMessage());
        }
    }

    private function buildOptions(string $method, array $query): array
    {
        $options = [
            'http_errors' => false,
        ];

        if ('GET' === $method) {
            $options['query'] = $query;
        }

        if ('POST' === $method) {
            $options['body'] = json_encode($query);
        }

        return $options;
    }
}
