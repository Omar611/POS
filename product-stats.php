<?php
require "includes/init.php";
Auth::requireAdminLogIn();

$db = new Database;
$conn = $db->getConn();

$stats = new Stats;
$product = new Product;


if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

    $product_info = $product->getProduct($conn, $_GET['id']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $start_date = $_POST['start_period'];
        $end_date = $_POST['end_period'];
    } else {

        $start_date = "1900-01-01";
        $end_date = "2200-01-01";
    }
    $customers = $stats->productTopCustomers($conn, $_GET['id'], $start_date, $end_date);
    $salesMen = $stats->productTopSalesMen($conn, $_GET['id'], $start_date, $end_date);
    $totalRevenue = 0;
    foreach ($customers as $customer) {
        $totalRevenue += $customer['TotalRevenue'];
    }
} else {
    die("<h1>Error 404 product Not Found</h1> <a href='stats.php'><h2>Go Back</h2></a>");
}
?>

<?php require "includes/header.php"; ?>

<div class="container">

    <h1 class="form-header"> product Information</h1>

    <table class="form-table">
        <tr>
            <th>Product ID:</th>
            <td><?= $product_info['id'] ?></td>
        </tr>
        <tr>
            <th>Product name:</th>
            <td><?= $product_info['name'] ?></td>
        </tr>
        <tr>
            <th>Description:</th>
            <td><?= ($product_info['description'] == "") ? "N/A" : $product_info['description']  ?></td>
        </tr>
        <tr>
            <th>Price:</th>
            <td><?= $product_info['price'] ?>$</td>
        </tr>
        <tr>
            <th>Cost:</th>
            <td><?= $product_info['cost'] ?>$</td>
        </tr>
        <tr>
            <th>Maximum Discount:</th>
            <td><?= $product_info['max_discount'] ?>%</td>
        </tr>
        <tr>
            <th>Avilable Stock:</th>
            <td><?= $product_info['avilable_stock'] ?></td>
        </tr>
    </table>

    <?php require "includes/stats-period.php" ?>

    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') : ?>
        <h4 class="form-header">Product stast for the period from <?= $start_date ?> to <?= $end_date ?></h4>
    <?php else : ?>
        <h4 class="form-header">Product stast sice the beginning of business activity</h4>
    <?php endif; ?>

    <table class="form-table">
        <tr>
            <th>Total Generated Revenue from Product "<?= $product_info['name'] ?>":</th>
            <td><?= $totalRevenue ?>$</td>
        </tr>
    </table>

    <h4 class="form-header">Top Buying Customers</h4>
    <table class="info_table">
        <thead>
            <tr>
                <th>Customer ID</th>
                <th>Customer Name</th>
                <th>Total Purchased Quantities</th>
                <th>Total Revenue from Customer</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer) : ?>
                <tr>
                    <td><?= $customer['customer_id'] ?> </td>
                    <td><?= $customer['name'] ?> </td>
                    <td><?= $customer['quantity'] ?> </td>
                    <td><?= $customer['TotalRevenue'] ?> </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h4 class="form-header">Top Selling EMployees</h4>
    <table class="info_table">
        <thead>
            <tr>
                <th>Emplyee ID</th>
                <th>Product Name</th>
                <th>Total Sold Quantities</th>
                <th>Total Revenue Per Employee</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($salesMen as $salesMan) : ?>
                <tr>
                    <td><?= $salesMan['staff_id'] ?> </td>
                    <td><?= $salesMan['name'] ?> </td>
                    <td><?= $salesMan['quantity'] ?> </td>
                    <td><?= $salesMan['TotalRevenue'] ?> </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require "includes/footer.php"; ?>