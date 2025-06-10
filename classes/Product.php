<?php

class Product {
    private string $name;
    private string $description;
    private string $category;
    private float $price;
    private string $expireDate;
    private int $stock;

    public function __construct(string $name, string $description, string $category, float $price, string $expireDate, int $stock) {
        $this->name = $name;
        $this->description = $description;
        $this->category = $category;
        $this->price = $price;
        $this->expireDate = $expireDate;
        $this->stock = $stock;
    }

    public function getName(): string { return $this->name; }
    public function getDescription(): string { return $this->description; }
    public function getCategory(): string { return $this->category; }
    public function getPrice(): float { return $this->price; }
    public function getExpireDate(): string { return $this->expireDate; }
    public function getStock(): int { return $this->stock; }
}