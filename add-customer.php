<?php
require "includes/init.php";

Auth::requireAdminLogIn();

$db = new Database;
$conn = $db->getConn();

$customer = new Customer;

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $customer->name = $_POST["name"];
    $customer->phone_number = $_POST["phone_number"];
    $customer->phone_number_2 = $_POST["phone_number_2"];
    $customer->email = $_POST["email"];
    $customer->address = $_POST["address"];
    $customer->area = $_POST["area"];


    if ($customer->addCustomer($conn)) {
        $id = $conn->lastInsertId();
        Url::redirect("sys/customers.php");
    }
}

?>

<?php require "includes/header.php"; ?>
<div class="container">

    <h2 class="form-header">Add New Product</h2>

    <?php if (!empty($customer->errors)) : ?>
        <ul>
            <?php foreach ($customer->errors as $error) : ?>
                <li class="form-errors"><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <?php require "includes/customer-form.php"; ?>
</div>

<?php require "includes/footer.php"; ?>