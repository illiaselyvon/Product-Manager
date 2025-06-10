<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../classes/ProductManager.php';

$database = new Database();
$manager = new ProductManager($database);

// Удаление по ?delete=ID
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $manager->delete($id);
    header("Location: products.php");
    exit;
}

// Получаем все продукты
$products = $manager->read();
?>

<?php include __DIR__ . '/../root/includes/header.php'; ?>

<div class="container mt-5">
  <div class="row tm-content-row">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 tm-block-col">
      <div class="tm-bg-primary-dark tm-block tm-block-products">
        <div class="tm-product-table-container">
          <table class="table table-hover tm-table-small tm-product-table">
            <thead>
              <tr>
                <th scope="col">&nbsp;</th>
                <th scope="col">NAME</th>
                <th scope="col">DESCRIPTION</th>
                <th scope="col">CATEGORY</th>
                <th scope="col">PRICE (€)</th>
                <th scope="col">IN STOCK</th>
                <th scope="col">EXPIRE DATE</th>
                <th scope="col">EDIT</th>
                <th scope="col">DELETE</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $product): ?>
                <tr>
                  <th scope="row"><input type="checkbox" /></th>
                  <td class="tm-product-name"><?= htmlspecialchars($product['name']) ?></td>
                  <td><?= htmlspecialchars($product['description']) ?></td>
                  <td><?= htmlspecialchars($product['category']) ?></td>
                  <td><?= number_format($product['price'], 2) ?> €</td>
                  <td><?= (int)$product['in_stock'] ?></td>
                  <td><?= htmlspecialchars($product['expire_date']) ?></td>
                  <td>
                    <a href="edit-product.php?id=<?= $product['id'] ?>" class="tm-product-edit-link" title="Edit">
                      <i class="fas fa-edit tm-product-edit-icon"></i>
                    </a>
                  </td>
                  <td>
                    <a href="products.php?delete=<?= $product['id'] ?>" class="tm-product-delete-link" onclick="return confirm('Удалить этот товар?');">
                      <i class="far fa-trash-alt tm-product-delete-icon"></i>
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <a href="add-product.php" class="btn btn-primary btn-block text-uppercase mb-3">Add New Product</a>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../root/includes/footer.php'; ?>
