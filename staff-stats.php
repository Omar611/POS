<?php
require "includes/init.php";
Auth::requireAdminLogIn();

$db = new Database;
$conn = $db->getConn();

$stats = new Stats;
$staff = new Staff;


if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

    $staff_info = $staff->getStaff($conn, $_GET['id']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $start_date = $_POST['start_period'];
        $end_date = $_POST['end_period'];
    } else {

        $start_date = "1900-01-01";
        $end_date = "2200-01-01";
    }
    $customers = $stats->staffTopCustomers($conn, $_GET['id'], $start_date, $end_date);
    $products = $stats->staffTopProduct($conn, $_GET['id'], $start_date, $end_date);
    $totalRevenue = 0;
    foreach ($customers as $customer) {
        $totalRevenue += $customer['TotalRevenue'];
    }
} else {
    die("<h1>Error 404 staff Not Found</h1> <a href='stats.php'><h2>Go Back</h2></a>");
}
?>

<?php require "includes/header.php"; ?>
<div class="container">

    <h1 class="form-header"> Staff Information</h1>

    <table class="form-table">
        <tr>
            <th>Staff ID:</th>
            <td><?= $staff_info['id'] ?></td>
        </tr>
        <tr>
            <th>Staff name:</th>
            <td><?= $staff_info['name'] ?></td>
        </tr>
        <tr>
            <th>Email:</th>
            <td><?= ($staff_info['email'] == "") ? "N/A" : $staff_info['email']  ?></td>
        </tr>
        <tr>
            <th>Phone Number:</th>
            <td><?= ($staff_info['phone_number'] == "") ? "N/A" : $staff_info['phone_number']  ?></td>
        </tr>
        <tr>
            <th>Department:</th>
            <td><?= $staff_info['dep'] ?></td>
        </tr>
        <tr>
            <th>Salary:</th>
            <td><?= $staff_info['salary'] ?></td>
        </tr>
    </table>

    <?php require "includes/stats-period.php" ?>

    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') : ?>
        <h4 class="form-header">staff stast for the period from <?= $start_date ?> to <?= $end_date ?></h4>
    <?php else : ?>
        <h4 class="form-header">staff stast sice the beginning of business activity</h4>
    <?php endif; ?>

    <table class="form-table">
        <tr>
            <th>Total Generated Revenue from "<?= $staff_info['name'] ?>":</th>
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

    <h4 class="form-header">Top Selling Products</h4>
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

</div>
<?php require "includes/footer.php"; ?>