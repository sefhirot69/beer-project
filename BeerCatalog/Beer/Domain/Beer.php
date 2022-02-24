<?php

declare(strict_types=1);

namespace BeerCatalog\Beer\Domain;

final class Beer
{
    private int $id;
    private string $name;
    private string $description;
    private ?BeerDetails $details;

    /**
     * @param int              $id
     * @param string           $name
     * @param string           $description
     * @param BeerDetails|null $details
     */
    public function __construct(int $id, string $name, string $description, ?BeerDetails $details = null)
    {

        $this->id          = $id;
        $this->name        = $name;
        $this->description = $description;
        $this->details     = $details;
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
     * @return BeerDetails
     */
    public function getDetails(): BeerDetails
    {

        return $this->details;
    }

}