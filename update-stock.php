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

    $edited_amount = isset($_POST["edited_amount"]) ? $_POST["edited_amount"] : 0;

    if ($product->updateStock($conn, $_GET['id'], $edited_amount)) {
        Logs::manualUpdate($conn, $_GET['id'], $product->name, $edited_amount, $_SESSION['user']);
        Url::redirect("sys/products.php");
    }
}

?>

<?php require "includes/header.php"; ?>
<div class="container">

    <h2 class="form-header">Edite Product's Stock</h2>

    <form action="" method="post" >
        <div class="form-container">

            <?php if (!empty($product->errors)) : ?>
                <ul>
                    <?php foreach ($product->errors as $error) : ?>
                        <li class="form-errors"><?= $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <table class="form-table">
                <tr>
                    <th>ID:</th>
                    <td><?= $_GET['id'] ?></td>
                </tr>
                <tr>
                    <th>Product Name:</th>
                    <td><?= $product->name ?></td>
                </tr>
                <tr>
                    <th>Avilable Stock:</th>
                    <td><?= $product->avilable_stock ?></td>
                </tr>
                <tr>
                    <th>
                        <label for="edited_amount">Increased/ Decreased Amount</label>
                    </th>
                    <td>
                        <input type="number" id="edited_amount" name="edited_amount" placeholder="Add or substract Amount" class="input-filed">
                    </td>
                </tr>
            </table>

            <button type="submit" class="btn-sumbit">Submit</button>
        </div>
    </form>
</div>
<?php require "includes/footer.php"; ?>