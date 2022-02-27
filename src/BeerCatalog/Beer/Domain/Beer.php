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

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getDetails(): ?BeerDetails
    {
        return $this->details;
    }

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
