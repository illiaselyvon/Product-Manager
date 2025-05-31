<?php
require_once 'Database.php';

class ProductManager {
    private PDO $db;

    public function __construct(Database $database) {
        $this->db = $database->getConnection();
    }

    public function create(Product $product): bool {
    $stmt = $this->db->prepare("
        INSERT INTO products (name, description, category, in_stock, created_at)
        VALUES (:name, :description, :category, :in_stock, :created_at)
    ");

    return $stmt->execute([
        'name' => $product->getName(),
        'description' => $product->getDescription(),
        'category' => $product->getCategory(),
        'in_stock' => $product->getInStock(),
        'created_at' => date('Y-m-d H:i:s')
    ]);
}
}

