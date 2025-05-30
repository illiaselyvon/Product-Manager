<?php

namespace App\Models;

class Product
{
    private int $id;
    private string $name;
    private string $description;
    private float $price;

    public function __construct(string $name, string $description, float $price, int $id = 0)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->id = $id;
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

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}
