<?php

declare(strict_types=1);

namespace BeerCatalog\Beer\Domain;

final class Beer
{
    private int $id;
    private string $name;
    private string $description;

    /**
     * @param int    $id
     * @param string $name
     * @param string $description
     */
    public function __construct(int $id, string $name, string $description)
    {

        $this->id          = $id;
        $this->name        = $name;
        $this->description = $description;
    }

    public static function create(int $id, string $name, string $description): self
    {

        return new self($id, $name, $description);
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

}