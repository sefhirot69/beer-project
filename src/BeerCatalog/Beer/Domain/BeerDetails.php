<?php

declare(strict_types=1);

namespace App\BeerCatalog\Beer\Domain;

use App\BeerCatalog\Beer\Domain\Dto\BeerDetailsDto;

final class BeerDetails
{
    private ?string $imageUrl;
    private string $tagLine;
    private string $firstBrewed;

    public function __construct(string $tagLine, string $firstBrewed, ?string $imageUrl = null)
    {
        $this->imageUrl = $imageUrl;
        $this->tagLine = $tagLine;
        $this->firstBrewed = $firstBrewed;
    }

    /**
     * @return static
     */
    public static function create(string $tagLine, string $firstBrewed, ?string $imageUrl = null): self
    {
        return new self($tagLine, $firstBrewed, $imageUrl);
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function getTagLine(): string
    {
        return $this->tagLine;
    }

    public function getFirstBrewed(): string
    {
        return $this->firstBrewed;
    }

    public function mapToDto(): BeerDetailsDto
    {
        return BeerDetailsDto::create(
            $this->getTagLine(),
            $this->getFirstBrewed(),
            $this->getImageUrl()
        );
    }
}
