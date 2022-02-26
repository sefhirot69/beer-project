<?php

namespace App\Tests\Unitary\Controller\Finder;

use App\BeerCatalog\Beer\Application\Find\FindBeerByFoodQueryHandlerInterface;
use App\BeerCatalog\Beer\Domain\Exceptions\BeersNotFoundException;
use App\BeerCatalog\Shared\Domain\Exceptions\HttpClientException;
use App\Controller\Finder\FindBeerByFoodWithDetailController;
use App\Tests\Unitary\BeerCatalog\Beer\Domain\CatalogBeerMother;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

final class FindBeerByFoodWithDetailControllerTest extends TestCase
{
    private $handlerMock;

    protected function setUp(): void
    {
        $this->handlerMock = $this->createMock(FindBeerByFoodQueryHandlerInterface::class);
    }

    /**
     * @test
     * @given
     * @when
     * @then
     */
    public function mustReturnAValidJsonWithCatalogBeerWithDetail() : void
    {
        //GIVEN
        $catalogFake = CatalogBeerMother::randomBeerWithDetail()->mapToDto();
        $this->handlerMock->expects(self::once())
            ->method('__invoke')
            ->willReturn($catalogFake);

        //WHEN
        $controller = new FindBeerByFoodWithDetailController($this->handlerMock);

        //THEN
        $result = $controller(new Request(['food' => 'a']));

        self::assertEquals(200, $result->getStatusCode());
        self::assertJson($result->getContent());
        self::assertSame(
            json_encode($catalogFake->getCatalogBeer(), 15),
            filter_var($result->getContent(), FILTER_DEFAULT)
        );
    }

    /**
     * @test
     * @given
     * @when
     * @then
     */
    public function mustReturnAnErrorWithStatusCode404() : void
    {
        //GIVEN
        $filterFood = 'a';
        $exception = new BeersNotFoundException($filterFood);
        $this->handlerMock->expects(self::once())
            ->method('__invoke')
            ->willThrowException($exception);

        //WHEN
        $controller = new FindBeerByFoodWithDetailController($this->handlerMock);

        //THEN
        $result = $controller(new Request(['food' => 'a']));

        self::assertEquals(404, $result->getStatusCode());
        self::assertJson($result->getContent());
    }

    /**
     * @test
     * @given
     * @when
     * @then
     */
    public function mustReturnAnErrorWithStatusCode400() : void
    {
        //GIVEN
        $error = 'An error occurred';
        $exception = new HttpClientException($error);
        $this->handlerMock->expects(self::once())
            ->method('__invoke')
            ->willThrowException($exception);

        //WHEN
        $controller = new FindBeerByFoodWithDetailController($this->handlerMock);

        //THEN
        $result = $controller(new Request(['food' => 'a']));

        self::assertEquals(400, $result->getStatusCode());
        self::assertJson($result->getContent());
    }

    /**
     * @test
     * @given
     * @when
     * @then
     */
    public function mustReturnAnErrorWithInvalidArgumentException() : void
    {
        //GIVEN


        //WHEN
        $controller = new FindBeerByFoodWithDetailController($this->handlerMock);

        //THEN
        $result = $controller(new Request(['fod' => 'a']));

        self::assertEquals(400, $result->getStatusCode());
        self::assertJson($result->getContent());
    }
}
