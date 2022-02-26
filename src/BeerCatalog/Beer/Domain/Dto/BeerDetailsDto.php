<?php

declare(strict_types=1);

namespace App\BeerCatalog\Beer\Domain\Dto;


final class BeerDetailsDto implements \JsonSerializable
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
        $this->imageUrl = $imageUrl;
        $this->tagLine = $tagLine;
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
     * @return string|null
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

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

}