<?php
require "includes/init.php";
Auth::requireAdminLogIn();

$db = new Database;
$conn = $db->getConn();

$stats = new Stats;
$customer = new customer;

if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

    $customer_info = $customer->getcustomer($conn, $_GET['id']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $start_date = $_POST['start_period'];
        $end_date = $_POST['end_period'];
    } else {
        $start_date = "1900-01-01";
        $end_date = "2200-01-01";
    }
    $products = $stats->customerTopProducts($conn, $_GET['id'], $start_date, $end_date);
    $salesMen = $stats->customerTopSalesMen($conn, $_GET['id'], $start_date, $end_date);

    $totalRevenue = 0;
    foreach ($products as $product) {
        $totalRevenue += $product['TotalRevenue'];
    }
} else {
    die("<h1>Error 404 Customer Not Found</h1> <a href='stats.php'><h2>Go Back</h2></a>");
}
?>

<?php require "includes/header.php"; ?>
<div class="container">

    <h1 class="form-header">Customer Information</h1>
        <table class="form-table">
            <tr>
                <th>Customer ID:</th>
                <td><?= $customer_info['id'] ?></td>
            </tr>
            <tr>
                <th>Customer name:</th>
                <td><?= $customer_info['name'] ?></td>
            </tr>
            <tr>
                <th>Phone Number(s):</th>
                <td><?= $customer_info['phone_number'] ?> <?= ($customer_info['phone_number_2'] == '') ? $customer_info['phone_number_2'] : "/ " . $customer_info['phone_number_2']  ?></td>

            </tr>
            <tr>
                <th>Email:</th>
                <td><?= $customer_info['email'] ?></td>
            </tr>
            <tr>
                <th>Address:</th>
                <td><?= $customer_info['address'] ?></td>
            </tr>
            <tr>
                <th>Sales Area:</th>
                <td><?= $customer_info['area'] ?></td>
            </tr>

        </table>
    <?php require "includes/stats-period.php" ?> <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') : ?> <h4 class="form-header">Customer Stats For The Period From <?= $start_date ?> To <?= $end_date ?></h4>
    <?php else : ?>
        <h4 class="form-header">All Customer Stats Since The Beginning Of Business Activity</h4>
    <?php endif; ?>

    <table class="form-table">
        <tr>
            <th>Total Generated Revenue from Customer "<?= $customer_info['name'] ?>":</th>
            <td><?= $totalRevenue ?>$</td>
        </tr>
    </table>


    <h4 class="form-header">Top Buying Products</h4>
    <table class="info_table">
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Total Purchased Quantities</th>
                <th>Total Revenue per Product</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product) : ?>
                <tr>
                    <td><?= $product['product_id'] ?> </td>
                    <td><?= $product['name'] ?> </td>
                    <td><?= $product['quantity'] ?> </td>
                    <td><?= $product['TotalRevenue'] ?> </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <h4 class="form-header">Top Selling Sales Men</h4>
    <table class="info_table">
        <thead>

            <tr>
                <th>Emplyee ID</th>
                <th>Product Name</th>
                <th>Total Revenue Per Employee</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($salesMen as $salesMan) : ?>
                <tr>
                    <td><?= $salesMan['staff_id'] ?> </td>
                    <td><?= $salesMan['name'] ?> </td>
                    <td><?= $salesMan['TotalRevenue'] ?> </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require "includes/footer.php"; ?>