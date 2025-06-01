<?php
require_once 'Database.php';
require_once 'ProductManager.php';

$database = new Database();
$productManager = new ProductManager($database);
$products = $productManager->read();
?>

<?php include 'header.php'; ?>

<div class="container mt-5">
  <div class="row tm-content-row">
    <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 tm-block-col">
      <div class="tm-bg-primary-dark tm-block tm-block-products">
        <div class="tm-product-table-container">
          <table class="table table-hover tm-table-small tm-product-table">
            <thead>
              <tr>
                <th scope="col">&nbsp;</th>
                <th scope="col">NAME</th>
                <th scope="col">DESCRIPTION</th>
                <th scope="col">CATEGORY</th>
                <th scope="col">PRICE</th>
                <th scope="col">IN STOCK</th>
                <th scope="col">EXPIRE DATE</th>
                <th scope="col">ACTION</th>
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
        <a href="delete-product.php?id=<?= $product['id'] ?>" class="tm-product-delete-link">
          <i class="far fa-trash-alt tm-product-delete-icon"></i>
        </a>
      </td>
    </tr>
  <?php endforeach; ?>
</tbody>

          </table>
        </div>
        <a href="add-product.php" class="btn btn-primary btn-block text-uppercase mb-3">Add new product</a>
        <button class="btn btn-primary btn-block text-uppercase">Delete selected products</button>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
