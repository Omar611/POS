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
        $product->description = $originalInfo["description"];
        $product->price = $originalInfo["price"];
        $product->cost = $originalInfo["cost"];
        $product->max_discount = $originalInfo["max_discount"];
        $product->avilable_stock = $originalInfo["avilable_stock"];
    } else {
        die("<h1>Error 404 Product Not Found</h1> <a href='products.php'><h2>Go Back</h2></a>");
    }
} else {
    die("<h1>Error 404 Product Not Found</h1> <a href='products.php'><h2>Go Back</h2></a>");
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $product->name = $_POST["name"];
    $product->description = $_POST["description"];
    $product->price = $_POST["price"];
    $product->cost = $_POST["cost"];
    $product->max_discount = $_POST["max_discount"];

    if ($product->updateProduct($conn, $_GET['id'])) {
        Url::redirect("sys/products.php");
    }
}

?>

<?php require "includes/header.php"; ?>
<div class="container">

    <h2 class="form-header">Update Product Info</h2>

    <?php if (!empty($product->errors)) : ?>
        <ul>
            <?php foreach ($product->errors as $error) : ?>
                <li class="form-errors"><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <?php require "includes/product-form.php"; ?>
</div>

<?php require "includes/footer.php"; ?>