<?php
require "includes/init.php";

$db = new Database;
$conn = $db->getConn();

$products = new Product;

$products = $products->showProducts($conn);

?>

<?php require "includes/header.php"; ?>

<div class="container">

    <h1 class="form-header">Products' Information</h1>

    <?php if (Auth::isAdminLoggedIn()) : ?>
        <div class="content-btns">
            <a href="add-product.php" class="btn-sec">Add A New Product</a>
            <a href="logs.php" class="btn-sec">Show stock edit History</a>
        </div>
    <?php endif ?>
    <div class="table-container">

        <table class="info_table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Selling Price</th>
                    <th>Maximum <br>Allowed Discount</th>
                    <?php if (Auth::isAdminLoggedIn()) : ?>
                        <th>Cost</th>
                        <th>Avilable Stock</th>
                    <?php endif ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <td> <?= $product['id'] ?> </td>
                        <td> <a href="product-stats.php?id=<?= $product['id'] ?>" class="btn-table"><?= $product['name'] ?> </td>
                        <td> <?= ($product['description'] == null) ? "N/A" : $product['description']  ?> </td>
                        <td> <?= $product['price'] ?> $ </td>
                        <td> <?= $product['max_discount'] ?> % </td>
                        <?php if (Auth::isAdminLoggedIn()) : ?>
                            <td> <?= $product['cost'] ?> $ </td>
                            <td> <?= $product['avilable_stock'] ?> </td>
                            <th><a href="update-product.php?id=<?= $product['id'] ?>" class="btn-table">Edit Product</a></th>
                            <th><a href="update-stock.php?id=<?= $product['id'] ?>" class="btn-table-sec">Update Stock</a></th>
                            <th><a href="delete-product.php?id=<?= $product['id'] ?> " class="btn-table">Delete Product</a></th>
                        <?php endif ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>

    </div>
</div>
<?php require "includes/footer.php"; ?>