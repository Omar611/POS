<?php
require "includes/init.php";
Auth::requireAdminLogIn();

$db = new Database;
$conn = $db->getConn();

$customer = new Customer;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    $originalInfo = $customer->getCustomer($conn, $_GET['id']);

    if ($originalInfo) {
        $customer->name = $originalInfo["name"];
        $customer->phone_number = $originalInfo["phone_number"];
        $customer->phone_number_2 = $originalInfo["phone_number_2"];
        $customer->email = $originalInfo["email"];
        $customer->address = $originalInfo["address"];
        $customer->area = $originalInfo["area"];
    } else {
        die("<h1>Error 404 Customer Not Found</h1> <a href='Customers.php'><h2>Go Back</h2></a>");
    }
} else {
    die("<h1>Error 404 Customer Not Found</h1> <a href='Customers.php'><h2>Go Back</h2></a>");
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $customer->name = $_POST["name"];
    $customer->phone_number = $_POST["phone_number"];
    $customer->phone_number_2 = $_POST["phone_number_2"];
    $customer->email = $_POST["email"];
    $customer->address = $_POST["address"];
    $customer->area = $_POST["area"];

    if ($customer->updateCustomer($conn, $_GET['id'])) {
        Url::redirect("sys/Customers.php");
    }
}

?>

<?php require "includes/header.php"; ?>
<div class="container">

    <h2 class="form-header">Update Customer Info</h2>

    <?php if (!empty($customer->errors)) : ?>
        <ul>
            <?php foreach ($customer->errors as $error) : ?>
                <li class="form-errors"><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <?php require "includes/Customer-form.php"; ?>
</div>

<?php require "includes/footer.php"; ?>