<?php

namespace App\Tests\Unitary\BeerCatalog\Shared\Infrastructure;

use App\Tests\Shared\DataMock\HttpClientResponse;
use App\BeerCatalog\Shared\Infrastructure\Exceptions\GuzzleHttpClientException;
use App\BeerCatalog\Shared\Infrastructure\GuzzleHttpClientRepository;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use PHPUnit\Framework\TestCase;

class GuzzleHttpClientRepositoryTest extends TestCase
{
    public function setUp(): void
    {
    }

    /**
     * @test
     * @Given method GET
     * @When call to function fetch
     * @Then should return a 200
     */
    public function fetchShouldReturnStatusOk(): void
    {
        $body = Utils::streamFor(HttpClientResponse::response());
        $mock = new MockHandler(
            [
                new Response(200, [], $body),
            ]
        );

        $handlerStack = HandlerStack::create($mock);
        $guzzleMock = new Client(
            [
                'handler' => $handlerStack,
            ]
        );

        $repository = new GuzzleHttpClientRepository($guzzleMock);
        $result = $repository->fetch('GET', '/test', []);

        self::assertEquals(200, $result['statusCode']);
    }

    /**
     * @test
     * @Given method GET
     * @When call to function fetch
     * @Then should return an exception
     */
    public function fetchShouldReturnToException(): void
    {
        $this->expectException(GuzzleHttpClientException::class);
        $this->expectErrorMessage('An error has occurred');

        //GIVEN
        $mock = new MockHandler(
            [
                new Response(400, []),
            ]
        );

        $handlerStack = HandlerStack::create($mock);
        $guzzleMock = new Client(
            [
                'handler' => $handlerStack,
            ]
        );

        //WHEN
        $repository = new GuzzleHttpClientRepository($guzzleMock);

        //THEN
        $repository->fetch('GET', '/test', []);
    }
}
