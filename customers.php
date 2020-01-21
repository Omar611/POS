<?php
require "includes/init.php";

$db = new Database;
$conn = $db->getConn();

$customers = new Customer;

$customers = $customers->showCustomers($conn);

?>

<?php require "includes/header.php"; ?>
<div class="container">
    <h1 class="form-header">Customers' Information</h1>

    <?php if (Auth::isAdminLoggedIn()) : ?>
        <div class="content-btns">
            <a href="add-customer.php" class="btn-sec">Add New Customer</a>
        </div>
    <?php endif ?>
    <div class="table-container">
        <table class="info_table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Primary <br>Phone number</th>
                    <th>2nd <br>Phone number</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Sales Area</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customers as $customer) : ?>
                    <tr>
                        <td> <?= $customer['id'] ?> </td>
                        <td> <a href="customer-stats.php?id=<?= $customer['id'] ?>" class="btn-table"><?= $customer['name'] ?></a></td>
                        <td> <?= ($customer['phone_number'] == null) ? "N/A" : $customer['phone_number'] ?> </td>
                        <td> <?= ($customer['phone_number_2'] == null) ? "N/A" : $customer['phone_number_2'] ?> </td>
                        <td> <?= ($customer['email'] == null) ? "N/A" : $customer['email'] ?> </td>
                        <td> <?= ($customer['address'] == null) ? "N/A" : $customer['address'] ?> </td>
                        <td> <?= $customer['area'] ?> </td>
                        <?php if (Auth::isAdminLoggedIn()) : ?>
                            <th><a href="update-customer.php?id=<?= $customer['id'] ?>" class="btn-table">Edit Customer</a></th>
                            <th><a href="customer-stats.php?id=<?= $customer['id'] ?>" class="btn-table-sec">Show Sales Stats.</a></th>
                            <th><a href="delete-customer.php?id=<?= $customer['id'] ?>" class="btn-table">Delete Customer</a></th>
                        <?php endif ?>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<?php require "includes/footer.php"; ?>