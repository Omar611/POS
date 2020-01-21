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
    } else {

        die("<h1>Error 404 Customer Not Found</h1> <a href='Customers.php'><h2>Go Back</h2></a>");
    }
} else {
    die("<h1>Error 404 Customer Not Found</h1> <a href='Customers.php'><h2>Go Back</h2></a>");
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if ($customer->deleteCustomer($conn, $_GET['id'])) {
        Url::redirect('sys/Customers.php');
    }
}


?>

<?php require "includes/header.php"; ?>

<div class="container">

    <?php if (isset($error)) : ?>
        <p><?= $error ?></p>
    <?php else : ?>

        <h3 class="form-errors">Are you sure you want to Delete Customer "<?= $customer->name ?>" ?</h3>
        <a href="Customers.php" class="btn-cancel"> Cancel</a>

        <br>
        <br>

        <form method="POST">
            <button type="submit" class="btn-delete">Delete</button>
        </form>
    <?php endif; ?>
</div>

<?php require "includes/footer.php"; ?>