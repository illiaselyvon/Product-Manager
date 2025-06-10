<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../classes/ProductManager.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];

    $database = new Database();
    $manager = new ProductManager($database);

    if ($manager->delete($id)) {
        header('Location: products.php');
        exit;
    } else {
        echo "Error.";
    }
} else {
    echo "Wrong ID product.";
}
