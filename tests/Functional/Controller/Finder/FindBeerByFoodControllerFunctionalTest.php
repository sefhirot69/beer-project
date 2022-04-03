<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller\Finder;

use App\BeerCatalog\Shared\Domain\HttpClientDataSource;
use App\BeerCatalog\Shared\Infrastructure\GuzzleHttpClientRepository;
use App\Tests\Shared\DataMock\ApiPunkResponse;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class FindBeerByFoodControllerFunctionalTest extends WebTestCase
{
    private HttpClientDataSource|MockObject $fetchMock;
    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->fetchMock = $this->createMock(HttpClientDataSource::class);
        $this->client = self::createClient();
    }

    /**
     * @test
     * @given
     * @when
     * @then
     */
    public function mustReturnAValidJsonWithCatalogBeerFunctional(): void
    {
        // GIVEN
        $this->fetchMock->expects(self::once())
            ->method('fetch')
            ->willReturn(json_decode(ApiPunkResponse::responseOk(), true, 512, JSON_THROW_ON_ERROR));

        // WHEN
        $this->client->getContainer()->set(GuzzleHttpClientRepository::class, $this->fetchMock);
        $this->client->request('GET', 'beer/food/pin');

        // THEN

        self::assertResponseIsSuccessful();
    }
}
