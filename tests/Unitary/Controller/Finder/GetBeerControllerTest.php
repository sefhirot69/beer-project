<?php

declare(strict_types=1);

namespace App\Tests\Unitary\Controller\Finder;

use App\BeerCatalog\Beer\Application\GetBeerQueryHandler;
use App\BeerCatalog\Shared\Domain\Exceptions\HttpClientException;
use App\Controller\Finder\GetBeerController;
use App\Tests\Unitary\BeerCatalog\Beer\Domain\BeerMother;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class GetBeerControllerTest extends TestCase
{
    private MockObject|GetBeerQueryHandler $getBeerQH;

    protected function setUp(): void
    {
        $this->getBeerQH = $this->createMock(GetBeerQueryHandler::class);
    }

    /**
     * @test
     */
    public function shouldExpectExceptionHttpExceptionWhenTryToReturnABeer(): void
    {
        // GIVEN
        $this->getBeerQH
            ->expects(self::once())
            ->method('__invoke')
            ->willThrowException(new HttpClientException('peito'));

        // WHEN
        $controller = new GetBeerController($this->getBeerQH);
        $result = $controller();

        // THEN
        self::assertEquals(400, $result->getStatusCode());
        self::assertJson($result->getContent());
    }

    /**
     * @test
     */
    public function shouldExpectExceptionHttpExceptionWhenTryToReturnABeerWithDetail(): void
    {
        // GIVEN
        $this->getBeerQH
            ->expects(self::once())
            ->method('__invoke')
            ->willThrowException(new HttpClientException('peito'));

        // WHEN
        $controller = new GetBeerController($this->getBeerQH);
        $result = $controller->withDetail();

        // THEN
        self::assertEquals(400, $result->getStatusCode());
        self::assertJson($result->getContent());
    }

    /**
     * @test
     */
    public function shouldReturnBeerWithDetail(): void
    {
        // GIVEN
        $beerFake = BeerMother::randomBeerWithDetail();
        $this->getBeerQH
            ->expects(self::once())
            ->method('__invoke')
            ->willReturn($beerFake->mapToDto()); // GIVEN

        // WHEN
        $controller = new GetBeerController($this->getBeerQH);
        $result = $controller->withDetail();

        // THEN
        self::assertEquals(400, $result->getStatusCode());
        self::assertJson($result->getContent());
    }

    /**
     * @test
     */
    public function shouldReturnBeer(): void
    {
        // GIVEN
        $beerFake = BeerMother::randomBeer();
        $this->getBeerQH
            ->expects(self::once())
            ->method('__invoke')
            ->willReturn($beerFake->mapToDto());

        // WHEN
        $controller = new GetBeerController($this->getBeerQH);
        $result = $controller();

        // THEN
        self::assertEquals(200, $result->getStatusCode());
        self::assertJson($result->getContent());
    }
}
