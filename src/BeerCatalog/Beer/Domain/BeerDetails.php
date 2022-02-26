<?php

declare(strict_types=1);

namespace App\BeerCatalog\Beer\Domain;

use App\BeerCatalog\Beer\Domain\Dto\BeerDetailsDto;
use App\BeerCatalog\Beer\Domain\Dto\BeerDto;

final class BeerDetails
{
    private string $imageUrl;
    private string $tagLine;
    private string $firstBrewed;

    /**
     * @param string $imageUrl
     * @param string $tagLine
     * @param string $firstBrewed
     */
    public function __construct(string $imageUrl, string $tagLine, string $firstBrewed)
    {

        $this->imageUrl    = $imageUrl;
        $this->tagLine     = $tagLine;
        $this->firstBrewed = $firstBrewed;
    }

    /**
     * @param string $imageUrl
     * @param string $tagLine
     * @param string $firstBrewed
     *
     * @return static
     */
    public static function create(string $imageUrl, string $tagLine, string $firstBrewed): self
    {

        return new self($imageUrl, $tagLine, $firstBrewed);
    }

    /**
     * @return string
     */
    public function getImageUrl(): string
    {

        return $this->imageUrl;
    }

    /**
     * @return string
     */
    public function getTagLine(): string
    {

        return $this->tagLine;
    }

    /**
     * @return string
     */
    public function getFirstBrewed(): string
    {

        return $this->firstBrewed;
    }

    /**
     * @return BeerDetailsDto
     */
    public function mapToDto(): BeerDetailsDto
    {
        return BeerDetailsDto::create(
            $this->getImageUrl(),
            $this->getTagLine(),
            $this->getFirstBrewed(),
        );
    }

}