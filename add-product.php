<?php
require "includes/init.php";

Auth::requireAdminLogIn();

$db = new Database;
$conn = $db->getConn();

$product = new Product;

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $product->name = $_POST["name"];
    $product->description = $_POST["description"];
    $product->price = $_POST["price"];
    $product->cost = $_POST["cost"];
    $product->max_discount = $_POST["max_discount"];


    if ($product->addProduct($conn)) {
        $id = $conn->lastInsertId();
        Url::redirect("sys/update-stock.php?id=$id");
    }
}

?>

<?php require "includes/header.php"; ?>
<div class="container">

    <h2 class="form-header">Add New Product</h2>
    
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