<?php
require "includes/init.php";
Auth::requireAdminLogIn();

$db = new Database;
$conn = $db->getConn();

$emp = new Staff;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    $originalInfo = $emp->getStaff($conn, $_GET['id']);

    if ($originalInfo) {

        $emp->name = $originalInfo["name"];
    } else {

        die("<h1>Error 404 Staff Not Found</h1> <a href='Staffs.php'><h2>Go Back</h2></a>");
    }
} else {
    die("<h1>Error 404 Staff Not Found</h1> <a href='Staffs.php'><h2>Go Back</h2></a>");
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if ($emp->deleteStaff($conn, $_GET['id'])) {
        Url::redirect('sys/Staffs.php');
    }
}


?>

<?php require "includes/header.php"; ?>
<div class="container">


    <?php if (isset($error)) : ?>
        <p class="form-errors"><?= $error ?></p>
    <?php else : ?>

        <h3 class="form-errors">Are you sure you want to Delete Staff "<?= $emp->name ?>" ?</h3>
        <a href="Staffs.php" class="btn-cancel"> Cancel</a>

        <form method="POST">
            <button type="submit" class="btn-delete">Delete</button>
        </form>
    <?php endif; ?>
</div>

<?php require "includes/footer.php"; ?>