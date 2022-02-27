<?php

declare(strict_types=1);

namespace App\BeerCatalog\Beer\Application\Find\Query;

final class FindBeerByFoodQuery
{
    private string $foodFilter;
    private bool $withDetail;

    public function __construct(string $foodFilter, bool $withDetail = false)
    {
        $this->foodFilter = $foodFilter;
        $this->withDetail = $withDetail;
    }

    /**
     * @return static
     */
    public static function create(string $foodFilter, bool $withDetail = false): self
    {
        return new self($foodFilter, $withDetail);
    }

    public function getFoodFilter(): string
    {
        return $this->foodFilter;
    }

    public function isWithDetail(): bool
    {
        return $this->withDetail;
    }
}
