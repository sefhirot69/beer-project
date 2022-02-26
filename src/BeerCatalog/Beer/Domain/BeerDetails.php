<?php

declare(strict_types=1);

namespace App\BeerCatalog\Beer\Domain;

use App\BeerCatalog\Beer\Domain\Dto\BeerDetailsDto;
use App\BeerCatalog\Beer\Domain\Dto\BeerDto;

final class BeerDetails
{
    private ?string $imageUrl;
    private string $tagLine;
    private string $firstBrewed;

    /**
     * @param string $tagLine
     * @param string $firstBrewed
     * @param string|null $imageUrl
     */
    public function __construct(string $tagLine, string $firstBrewed, ?string $imageUrl = null)
    {

        $this->imageUrl    = $imageUrl;
        $this->tagLine     = $tagLine;
        $this->firstBrewed = $firstBrewed;
    }

    /**
     * @param string $tagLine
     * @param string $firstBrewed
     *
     * @param string|null $imageUrl
     * @return static
     */
    public static function create(string $tagLine, string $firstBrewed, ?string $imageUrl = null): self
    {

        return new self($tagLine, $firstBrewed, $imageUrl);
    }

    /**
     * @return null|string
     */
    public function getImageUrl(): ?string
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
            $this->getTagLine(),
            $this->getFirstBrewed(),
            $this->getImageUrl()
        );
    }

}