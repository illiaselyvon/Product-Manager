<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../classes/Product.php';
require_once __DIR__ . '/../classes/ProductManager.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $expireDate = trim($_POST['expire_date'] ?? '');
    $priceRaw = $_POST['price'] ?? null;
    $stockRaw = $_POST['stock'] ?? null;

    if (!is_numeric($priceRaw) || !is_numeric($stockRaw)) {
        die("Цена и количество должны быть числами.");
    }

    $price = (float)$priceRaw;
    $stock = (int)$stockRaw;

    $product = new Product($name, $description, $category, $price, $expireDate, $stock);
    $database = new Database();
    $manager = new ProductManager($database);

    if ($manager->create($product)) {
        header("Location: products.php");
        exit;
    } else {
        echo "<script>alert('Ошибка при добавлении товара');</script>";
    }
}
?>

<?php include __DIR__ . '/../root/includes/header.php'; ?>

<div class="container tm-mt-big tm-mb-big">
  <div class="row">
    <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12 mx-auto">
      <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
        <div class="row">
          <div class="col-12">
            <h2 class="tm-block-title d-inline-block">Add Product</h2>
          </div>
        </div>
        <div class="row tm-edit-product-row">
          <div class="col-xl-6 col-lg-6 col-md-12">
            <form action="add-product.php" method="POST" class="tm-edit-product-form">
              <div class="form-group mb-3">
                <label for="name">Product Name</label>
                <input id="name" name="name" type="text" class="form-control validate" required />
              </div>

              <div class="form-group mb-3">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control validate" rows="3" required></textarea>
              </div>

              <div class="form-group mb-3">
                <label for="category">Category</label>
                <select name="category" class="custom-select tm-select-accounts" id="category" required>
                  <option selected disabled>Select category</option>
                  <option value="New Arrival">New Arrival</option>
                  <option value="Most Popular">Most Popular</option>
                  <option value="Trending">Trending</option>
                </select>
              </div>

              <div class="form-group mb-3">
                <label for="price">Price</label>
                <input id="price" name="price" type="number" step="0.01" min="0" class="form-control validate" required />
              </div>

              <div class="form-group mb-3">
                <label for="expire_date">Expire Date</label>
                <input id="expire_date" name="expire_date" type="date" class="form-control validate" />
              </div>

              <div class="form-group mb-3">
                <label for="stock">Units In Stock</label>
                <input id="stock" name="stock" type="number" class="form-control validate" required />
              </div>

              <div class="form-group mb-3">
                <button type="submit" class="btn btn-primary btn-block text-uppercase">Add Product Now</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../root/includes/footer.php'; ?>
