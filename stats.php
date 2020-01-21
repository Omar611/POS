<?php
require "includes/init.php";
Auth::requireAdminLogIn();

$db = new Database;
$conn = $db->getConn();

$stats = new Stats;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['start_period']) && isset($_POST['end_period'])) {

    $start_date = $_POST['start_period'];
    $end_date = $_POST['end_period'];

    $customers_purchases = $stats->customersPurchases($conn, $start_date, $end_date);
    $employees_sales = $stats->staffRevenue($conn, $start_date, $end_date);
    $products_sales = $stats->productsRevenue($conn, $start_date, $end_date);

    $total_reveue = 0;
    foreach ($customers_purchases as $customer_purchases) {
        $total_reveue += $customer_purchases['TotalRevenue'];
    }

    $total_purchases = 0;
    foreach ($customers_purchases as $customer_purchases) {
        $total_purchases += ($customer_purchases['TotalPurchases'] * (1 - ($customer_purchases['discount'] / 100)));
    }
}
?>

<?php require "includes/header.php"; ?>
<div class="container">

    <h1 class="form-header">Revenue Satistics</h1>

    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($start_date) && isset($end_date)) : ?>

        <h2 class="form-header">Bases on Revenue From the period of <?= $start_date ?> to <?= $end_date ?> Top Revenue Generators Are :</h2>

        <h4 class="form-header">Customers' Purchases & Revenue Statistics</h4>
        <div class="table-container">
            <table class="info_table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer Name</th>
                        <th>Total Purchases in $</th>
                        <th>Revenue Generated in $</th>
                        <th>Percentage of Total Sales</th>
                        <th>Percentage of Total Revenue</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($customers_purchases as $customer_purchases) : ?>
                        <tr>
                            <td><?= $customer_purchases['id'] ?></td>
                            <td><a href="customer-stats.php?id=<?= $customer_purchases['id'] ?>" class="btn-table"><?= $customer_purchases['name'] ?></a></td>
                            <td><?= $customer_purchases['TotalPurchases'] * (1 - ($customer_purchases['discount'] / 100)) ?></td>
                            <td><?= $customer_purchases['TotalRevenue'] ?></td>
                            <td><?= round(((($customer_purchases['TotalPurchases'] * (1 - ($customer_purchases['discount'] / 100))) / $total_purchases) * 100), 2) ?> %</td>
                            <td><?= round(((($customer_purchases['TotalRevenue']) / $total_reveue) * 100), 2) ?> %</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <h4 class="form-header">Employees' Sales & Revenue Statistics</h4>
        <div class="table-container">
            <table class="info_table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Employee's Name</th>
                        <th>Total Sales in $</th>
                        <th>Revenue Generated in $</th>
                        <th>Percentage of Total Sales</th>
                        <th>Percentage of Total Revenue</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($employees_sales as $emp_sales) : ?>
                        <tr>
                            <td><?= $emp_sales['id'] ?></td>
                            <td><a href="staff-stats.php?id=<?= $emp_sales['id'] ?>" class="btn-table"><?= $emp_sales['name'] ?></a></td>
                            <td><?= $emp_sales['TotalPurchases'] * (1 - ($emp_sales['discount'] / 100)) ?></td>
                            <td><?= $emp_sales['TotalRevenue'] ?></td>
                            <td><?= round(((($emp_sales['TotalPurchases'] * (1 - ($emp_sales['discount'] / 100))) / $total_purchases) * 100), 2) ?> %</td>
                            <td><?= round(((($emp_sales['TotalRevenue']) / $total_reveue) * 100), 2) ?> %</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <h4 class="form-header">Products' Sales & Revenue Statistics</h4>
        <div class="table-container">
            <table class="info_table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Total Sold Units</th>
                        <th>Total Sales in $</th>
                        <th>Revenue Generated in $</th>
                        <th>Percentage of Total Sales</th>
                        <th>Percentage of Total Revenue</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products_sales as $product_sales) : ?>
                        <tr>
                            <td><?= $product_sales['id'] ?></td>
                            <td><a href="product-stats.php?id=<?= $product_sales['id'] ?>" class="btn-table"><?= $product_sales['name'] ?></a></td>
                            <td><?= $product_sales['SoldUints'] ?></td>
                            <td><?= $product_sales['TotalPurchases'] * (1 - ($product_sales['discount'] / 100)) ?></td>
                            <td><?= $product_sales['TotalRevenue'] ?></td>
                            <td><?= round(((($product_sales['TotalPurchases'] * (1 - ($product_sales['discount'] / 100))) / $total_purchases) * 100), 2) ?> %</td>
                            <td><?= round(((($product_sales['TotalRevenue']) / $total_reveue) * 100), 2) ?> %</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <?php require "includes/stats-period.php"; ?>
        <h1 class="form-header">OR</h1>
        <?php require "includes/search-bar.php"; ?>
    <?php endif; ?>
</div>

<?php require "includes/footer.php"; ?>