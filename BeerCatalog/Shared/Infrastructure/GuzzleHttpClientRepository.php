<?php

namespace BeerCatalog\Shared\Infrastructure;

use BeerCatalog\Shared\Domain\Exceptions\HttpClientException;
use BeerCatalog\Shared\Domain\HttpClientDataSource;
use BeerCatalog\Shared\Infrastructure\Exceptions\GuzzleHttpClientException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;

final class GuzzleHttpClientRepository implements HttpClientDataSource
{

    /**
     * @var ClientInterface
     */
    private ClientInterface $client;

    public function __construct(ClientInterface $client)
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