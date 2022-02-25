<?php

declare(strict_types=1);


namespace BeerCatalog\Beer\Domain\Dto;

final class CatalogBeerDto implements \JsonSerializable
{
    /**
     * @var BeerDto[]
     */
    private array $catalogBeer;

    /**
     * @param BeerDto[] $catalogBeer
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
     * @return BeerDto[]
     */
    public function getCatalogBeer(): array
    {
        return $this->catalogBeer;
    }


    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}