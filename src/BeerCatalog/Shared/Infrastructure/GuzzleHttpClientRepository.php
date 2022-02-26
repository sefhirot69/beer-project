<?php

namespace App\BeerCatalog\Shared\Infrastructure;

use App\BeerCatalog\Shared\Domain\Exceptions\HttpClientException;
use App\BeerCatalog\Shared\Domain\HttpClientDataSource;
use App\BeerCatalog\Shared\Infrastructure\Exceptions\GuzzleHttpClientException;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;

final class GuzzleHttpClientRepository implements HttpClientDataSource
{

    /**
     * @var Client
     */
    private Client $client;

    public function __construct(Client $client)
    {

        $this->client = $client;
    }

    /**
     * @inheritDoc
     */
    public function fetch(string $method, string $endpoint, array $query): array
    {

        try {
            $options  = $this->buildOptions($method, $query);
            $response = $this->client->request($method, $endpoint, $options);
            if ($response->getStatusCode() != 200) {
                throw new GuzzleHttpClientException('An error has occurred');
            }

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException|\Exception|HttpClientException $exception) {
            throw new GuzzleHttpClientException($exception->getMessage());
        }
    }

    /**
     * @param string $method
     * @param array  $query
     *
     * @return array
     */
    private function buildOptions(string $method, array $query): array
    {

        $options = [
            'http_errors' => false,
        ];

        if ($method === 'GET') {
            $options['query'] = $query;
        }

        if ($method === 'POST') {
            $options['body'] = json_encode($query);
        }

        return $options;
    }

}