<?php
require_once 'Database.php';
require_once 'Product.php';

class ProductManager {
    private PDO $db;

    public function __construct(Database $database) {
        $this->db = $database->getConnection();
    }

    public function create(Product $product): bool {
        $stmt = $this->db->prepare("
            INSERT INTO products (name, description, category, price, in_stock, expire_date, created_at)
            VALUES (:name, :description, :category, :price, :in_stock, :expire_date, :created_at)
        ");

        return $stmt->execute([
            'name' => $product->getName(),
            'description' => $product->getDescription(),
            'category' => $product->getCategory(),
            'price' => $product->getPrice(),
            'in_stock' => $product->getStock(),
            'expire_date' => $product->getExpireDate(),
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}