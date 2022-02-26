<?php

declare(strict_types=1);


namespace App\BeerCatalog\Beer\Domain;

use App\BeerCatalog\Beer\Domain\Dto\CatalogBeerDto;

final class CatalogBeer
{
    /**
     * @var Beer[]
     */
    private array $catalogBeer;

    /**
     * @param Beer[] $catalogBeer
     */
    public function __construct(array $catalogBeer)
    {
        $this->catalogBeer = $catalogBeer;
    }

    public static function create(array $catalogBeer): self
    {
        return new self($catalogBeer);
    }

    /**
     * @return Beer[]
     */
    public function getCatalogBeer(): array
    {
        return $this->catalogBeer;
    }

    public function mapToDto(): CatalogBeerDto
    {
        return CatalogBeerDto::create(
            array_map(
                static function (Beer $beer) {
                    return $beer->mapToDto();
                },
                $this->getCatalogBeer()
            )
        );
    }
}