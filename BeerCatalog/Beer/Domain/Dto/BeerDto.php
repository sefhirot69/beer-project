<?php

declare(strict_types=1);

namespace BeerCatalog\Beer\Domain\Dto;

final class BeerDto implements \JsonSerializable
{
    private int $id;
    private string $name;
    private string $description;
    private ?BeerDetailsDto $details;

    /**
     * @param int                 $id
     * @param string              $name
     * @param string              $description
     * @param BeerDetailsDto|null $details
     */
    public function __construct(int $id, string $name, string $description, ?BeerDetailsDto $details = null)
    {

        $this->id          = $id;
        $this->name        = $name;
        $this->description = $description;
        $this->details     = $details;
    }

    public static function create(int $id, string $name, string $description, ?BeerDetailsDto $details = null): self
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
     * @return BeerDetailsDto|null
     */
    public function getDetails(): ?BeerDetailsDto
    {

        return $this->details;
    }

    public function jsonSerialize(): array
    {

        return get_object_vars($this);
    }

}