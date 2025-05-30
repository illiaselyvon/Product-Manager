<?php
require_once 'Database.php';
require_once 'Product.php';
require_once 'ProductManager.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $price = floatval($_POST['price'] ?? 0);
    $expireDate = trim($_POST['expire_date'] ?? '');
    $stock = intval($_POST['stock'] ?? 0);

    $imageName = null;
    if (!empty($_FILES['image']['name'])) {
        $uploadDir = 'uploads/';
        $imageName = basename($_FILES['image']['name']);
        $uploadPath = $uploadDir . $imageName;

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
            echo "<script>alert('Не удалось загрузить изображение');</script>";
            $imageName = null;
        }
    }

    if ($name && $description && $category && $price > 0 && $expireDate && $stock >= 0) {
        $product = new Product($name, $description, $category, $price, $imageName, $stock, $expireDate);
        $manager = new ProductManager();

        if ($manager->create($product)) {
            header("Location: products.php?success=1");
            exit;
        } else {
            echo "<script>alert('Ошибка при добавлении товара');</script>";
        }
    } else {
        echo "<script>alert('Пожалуйста, заполните все поля корректно');</script>";
    }
}
?>

<?php include 'header.php'; ?>

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
            <form action="add_product.php" method="POST" enctype="multipart/form-data" class="tm-edit-product-form">
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
                <select name="category" class="custom-select tm-select-accounts" id="category">
                  <option selected disabled>Select category</option>
                  <option value="New Arrival">New Arrival</option>
                  <option value="Most Popular">Most Popular</option>
                  <option value="Trending">Trending</option>
                </select>
              </div>

              <div class="form-group mb-3">
                <label for="price">Price</label>
                <input id="price" name="price" type="text" class="form-control validate" required />
              </div>

              <div class="row">
                <div class="form-group mb-3 col-xs-12 col-sm-6">
                  <label for="expire_date">Expire Date</label>
                  <input id="expire_date" name="expire_date" type="text" class="form-control validate" />
                </div>

                <div class="form-group mb-3 col-xs-12 col-sm-6">
                  <label for="stock">Units In Stock</label>
                  <input id="stock" name="stock" type="text" class="form-control validate" required />
                </div>
              </div>
          </div>

          <div class="col-xl-6 col-lg-6 col-md-12 mx-auto mb-4">
            <div class="tm-product-img-dummy mx-auto">
              <i class="fas fa-cloud-upload-alt tm-upload-icon"
                 onclick="document.getElementById('fileInput').click();"></i>
            </div>
            <div class="custom-file mt-3 mb-3">
              <input id="fileInput" name="image" type="file" style="display:none;" />
              <input type="button" class="btn btn-primary btn-block mx-auto"
                     value="UPLOAD PRODUCT IMAGE"
                     onclick="document.getElementById('fileInput').click();" />
            </div>
          </div>

          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block text-uppercase">Add Product Now</button>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
