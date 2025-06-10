<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../classes/Product.php';
require_once __DIR__ . '/../classes/ProductManager.php';

$database = new Database();
$manager = new ProductManager($database);

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Wrong ID.");
}

$id = (int)$_GET['id'];
$productData = $manager->findById($id);

if (!$productData) {
    die("Product not found.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $expireDate = trim($_POST['expire_date'] ?? '');
    $priceRaw = $_POST['price'] ?? '0';
    $stockRaw = $_POST['stock'] ?? '0';

    $price = (float) filter_var($priceRaw, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $stock = (int) filter_var($stockRaw, FILTER_SANITIZE_NUMBER_INT);

    $product = new Product($name, $description, $category, $price, $expireDate, $stock);

    if ($manager->update($product, $id)) {
        header("Location: products.php");
        exit;
    } else {
        echo "<script>alert('Error');</script>";
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
            <h2 class="tm-block-title d-inline-block">Edit Product</h2>
          </div>
        </div>
        <div class="row tm-edit-product-row">
          <div class="col-xl-6 col-lg-6 col-md-12">
            <form action="" method="post" class="tm-edit-product-form">
              <div class="form-group mb-3">
                <label for="name">Product Name</label>
                <input id="name" name="name" type="text" value="<?= htmlspecialchars($productData['name']) ?>" class="form-control validate" required />
              </div>

              <div class="form-group mb-3">
                <label for="description">Description</label>
                <textarea name="description" class="form-control validate tm-small" rows="5" required><?= htmlspecialchars($productData['description']) ?></textarea>
              </div>

              <div class="form-group mb-3">
                <label for="category">Category</label>
                <select name="category" class="custom-select tm-select-accounts" id="category" required>
                  <option disabled>Select category</option>
                  <option value="New Arrival" <?= $productData['category'] === 'New Arrival' ? 'selected' : '' ?>>New Arrival</option>
                  <option value="Most Popular" <?= $productData['category'] === 'Most Popular' ? 'selected' : '' ?>>Most Popular</option>
                  <option value="Trending" <?= $productData['category'] === 'Trending' ? 'selected' : '' ?>>Trending</option>
                </select>
              </div>

              <div class="form-group mb-3">
                <label for="price">Price</label>
                <input id="price" name="price" type="number" step="0.01" value="<?= number_format((float)$productData['price'], 2) ?>" class="form-control validate" required />
              </div>

              <div class="row">
                <div class="form-group mb-3 col-xs-12 col-sm-6">
                  <label for="expire_date">Expire Date</label>
                  <input id="expire_date" name="expire_date" type="date" value="<?= htmlspecialchars($productData['expire_date']) ?>" class="form-control validate" />
                </div>

                <div class="form-group mb-3 col-xs-12 col-sm-6">
                  <label for="stock">Units In Stock</label>
                  <input id="stock" name="stock" type="number" value="<?= (int)$productData['in_stock'] ?>" class="form-control validate" required />
                </div>
              </div>

              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block text-uppercase">Update Now</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../root/includes/footer.php'; ?>
