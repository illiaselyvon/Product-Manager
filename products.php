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
                <th scope="col">PRODUCT NAME</th>
                <th scope="col">UNIT SOLD</th>
                <th scope="col">IN STOCK</th>
                <th scope="col">EXPIRE DATE</th>
                <th scope="col">&nbsp;</th>
              </tr>
            </thead>
            <tbody>
                           <tr>
                <th scope="row"><input type="checkbox" /></th>
                <td class="tm-product-name">Lorem Ipsum Product 1</td>
                <td>1,450</td>
                <td>550</td>
                <td>28 March 2019</td>
                <td><a href="#" class="tm-product-delete-link"><i class="far fa-trash-alt tm-product-delete-icon"></i></a></td>
              </tr>
            
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
