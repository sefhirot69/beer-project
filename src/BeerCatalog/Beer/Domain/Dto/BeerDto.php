<?php

declare(strict_types=1);

namespace App\BeerCatalog\Beer\Domain\Dto;

final class BeerDto implements \JsonSerializable
{
    private int $id;
    private string $name;
    private string $description;
    private ?BeerDetailsDto $details;

    public function __construct(int $id, string $name, string $description, ?BeerDetailsDto $details = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->details = $details;
    }

    public static function create(int $id, string $name, string $description, ?BeerDetailsDto $details = null): self
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

    public function getDetails(): ?BeerDetailsDto
    {
        return $this->details;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
