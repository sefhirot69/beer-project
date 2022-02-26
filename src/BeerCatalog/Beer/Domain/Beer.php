<?php

declare(strict_types=1);

namespace App\BeerCatalog\Beer\Domain;

use App\BeerCatalog\Beer\Domain\Dto\BeerDto;

final class Beer
{
    private int $id;
    private string $name;
    private string $description;
    private ?BeerDetails $details;

    /**
     * @param int $id
     * @param string $name
     * @param string $description
     * @param BeerDetails|null $details
     */
    public function __construct(int $id, string $name, string $description, ?BeerDetails $details = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->details = $details;
    }

    public static function create(int $id, string $name, string $description, ?BeerDetails $details = null): self
    {
        return new self($id, $name, $description, $details);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return BeerDetails|null
     */
    public function getDetails(): ?BeerDetails
    {
        return $this->details;
    }

    /**
     * @return BeerDto
     */
    public function mapToDto(): BeerDto
    {
        return BeerDto::create(
            $this->getId(),
            $this->getName(),
            $this->getDescription(),
            null !== $this->getDetails() ? $this->getDetails()->mapToDto() : null
        );
    }

}