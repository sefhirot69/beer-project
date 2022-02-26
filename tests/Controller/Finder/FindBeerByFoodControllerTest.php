<?php

declare(strict_types=1);

namespace App\Tests\Controller\Finder;

use App\BeerCatalog\Beer\Application\Find\FindBeerByFoodQueryHandlerInterface;
use App\Controller\Finder\FindBeerByFoodController;
use App\Tests\BeerCatalog\Beer\Domain\CatalogBeerMother;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

final class FindBeerByFoodControllerTest extends TestCase
{
    private $handlerMock;

    protected function setUp(): void
    {
        $this->handlerMock = $this->createMock(FindBeerByFoodQueryHandlerInterface::class);
    }

    /**
     * @test
     *
     */
    public function mustReturnAValidJsonWithCatalogBeer() : void
    {
        //GIVEN
        $catalogFake = CatalogBeerMother::randomBeer()->mapToDto();
        $this->handlerMock->expects(self::once())
            ->method('__invoke')
            ->willReturn($catalogFake);

        //WHEN
        $controller = new FindBeerByFoodController($this->handlerMock);

        //THEN
        $result = $controller(new Request());

        self::assertEquals(200, $result->getStatusCode());
        self::assertJson($result->getContent());
        self::assertSame(
            json_encode($catalogFake->getCatalogBeer()),
            filter_var($result->getContent(), FILTER_DEFAULT)
        );
    }

}
