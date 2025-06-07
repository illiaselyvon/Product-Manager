<?php

class Database {
    private $host = 'localhost';
    private $dbname = 'php_products';
    private $user = 'root';
    private $pass = '';

    private $pdo;

    public function __construct() {
        try {
            $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=utf8mb4";
            $this->pdo = new PDO($dsn, $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->createProductsTable($this->pdo);
            $this->createUsersTable($this->pdo);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit;
        }
    }

    private function createProductsTable(PDO $pdo): void {
        $sql = "
            CREATE TABLE IF NOT EXISTS products (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                description TEXT NOT NULL,
                category VARCHAR(100) NOT NULL,
                price DECIMAL(10,2) NOT NULL,
                in_stock INT NOT NULL,
                expire_date DATE,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            );
        ";
        $pdo->prepare($sql)->execute();
    }

    private function createUsersTable(PDO $pdo): void {
        $sql = "
            CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(100) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            );
        ";
        $pdo->prepare($sql)->execute();
    }

    public function addProduct(string $name, int $unitSold, int $inStock, string $expireDate): bool {
        $sql = "INSERT INTO products (name, unit_sold, in_stock, expire_date) VALUES (:name, :unit_sold, :in_stock, :expire_date)";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':name' => $name,
            ':unit_sold' => $unitSold,
            ':in_stock' => $inStock,
            ':expire_date' => $expireDate
        ]);
    }

    public function getConnection(): PDO {
        return $this->pdo;
    }
}
