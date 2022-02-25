<?php

declare(strict_types=1);


namespace BeerCatalog\Beer\Application\Find\Query;

final class FindBeerByFoodQuery
{
    private string $foodFilter;
    private bool $withDetail;

    /**
     * @param string $foodFilter
     * @param bool   $withDetail
     */
    public function __construct(string $foodFilter, bool $withDetail = false)
    {

        $this->foodFilter = $foodFilter;
        $this->withDetail = $withDetail;
    }

    /**
     * @param string $foodFilter
     * @param bool   $withDetail
     *
     * @return static
     */
    public static function create(string $foodFilter, bool $withDetail = false): self
    {

        return new self($foodFilter, $withDetail);
    }

    /**
     * @return string
     */
    public function getFoodFilter(): string
    {

        return $this->foodFilter;
    }

    /**
     * @return bool
     */
    public function isWithDetail(): bool
    {

        return $this->withDetail;
    }

}