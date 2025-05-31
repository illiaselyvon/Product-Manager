<?php


class Product {
    private string $name;
    private string $description;
    private string $category;
    private string $expireDate;
    private int $stock;

    public function __construct(string $name, string $description, string $category, int $stock) {
        $this->name = $name;
        $this->description = $description;
        $this->category = $category;
        $this->expireDate = $expireDate;
        $this->stock = $stock;
    }

    public function getName(): string { return $this->name; }
    public function getDescription(): string { return $this->description; }
    public function getCategory(): string { return $this->category; }
    public function getStock(): int { return $this->stock; }
}