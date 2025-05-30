<?php
use PDO;

class ProductManager
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function create(Product $product): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO products (name, description, price) 
            VALUES (:name, :description, :price)
        ");

        return $stmt->execute([
            'name' => $product->getName(),
            'description' => $product->getDescription(),
            'price' => $product->getPrice()
        ]);
    }
}
