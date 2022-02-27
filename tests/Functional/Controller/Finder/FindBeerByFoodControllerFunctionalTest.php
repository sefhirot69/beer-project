<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller\Finder;

use App\BeerCatalog\Shared\Domain\HttpClientDataSource;
use App\Tests\Shared\DataMock\ApiPunkResponse;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class FindBeerByFoodControllerFunctionalTest extends WebTestCase
{
    private $fetchMock;
    private $client;

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
        //GIVEN
        $this->fetchMock->expects(self::once())
            ->method('fetch')
            ->willReturn(json_decode(ApiPunkResponse::responseOk(), true));

        //WHEN
        $router = $this->client->getContainer()->get('router');
        $this->client->getContainer()->set(HttpClientDataSource::class, $this->fetchMock);
        $crawler = $this->client->request('GET', $router->generate('app_find_beer').'?food=a');

        //THEN

        self::assertResponseIsSuccessful();
    }
}
