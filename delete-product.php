<?php
require "includes/init.php";
Auth::requireAdminLogIn();

$db = new Database;
$conn = $db->getConn();

$product = new Product;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    $originalInfo = $product->getProduct($conn, $_GET['id']);

    if ($originalInfo) {

        $product->name = $originalInfo["name"];
        $product->avilable_stock = $originalInfo["avilable_stock"];
    } else {

        die("<h1>Error 404 Product Not Found</h1> <a href='products.php'><h2>Go Back</h2></a>");
    }
} else {
    die("<h1>Error 404 Product Not Found</h1> <a href='products.php'><h2>Go Back</h2></a>");
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if ($product->avilable_stock != 0) {
        $error = "<h3>Please empty product\'s stock before deleting the Product</h3>
        <a href='products.php'>Go back</a>
        <a href='update-stock.php?id={$_GET['id']}'>Empty Product's Stock</a>";
    } else {
        if ($product->deleteProduct($conn, $_GET['id'])) {
            Url::redirect('sys/products.php');
        }
    }
}

?>

<?php require "includes/header.php"; ?>
<div class="container">

    <?php if (isset($error)) : ?>
        <p class="form-errors"><?= $error ?></p>
    <?php else : ?>

        <h3 class="form-errors">Are you sure you want to Delete Product "<?= $product->name ?>" ?</h3>

        <a href="products.php" class="btn-cancel"> Cancel</a>

        <form method="POST">
            <button type="submit" class="btn-delete">Delete</button>
        </form>
    <?php endif; ?>
</div>

<?php require "includes/footer.php"; ?>