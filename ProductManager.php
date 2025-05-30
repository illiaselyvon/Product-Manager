<?php
class ProductManager {
    private PDO $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function create(Product $product): bool {
        $stmt = $this->db->prepare("
            INSERT INTO products (name, in_stock, expire_date)
            VALUES (:name, :in_stock, :expire_date)
        ");

        return $stmt->execute([
            'name' => $product->getName(),
            'in_stock' => $product->getInStock(),
            'expire_date' => $product->getExpireDate(),
        ]);
    }
}

