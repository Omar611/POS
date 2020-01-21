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
        $emp->email = $originalInfo["email"];
        $emp->phone_number = $originalInfo["phone_number"];
        $emp->dep = $originalInfo["dep"];
        $emp->salary = $originalInfo["salary"];
    } else {
        die("<h1>Error 404 SupdateStaff Not Found</h1> <a href='SupdateStaffs.php'><h2>Go Back</h2></a>");
    }
} else {
    die("<h1>Error 404 SupdateStaff Not Found</h1> <a href='SupdateStaffs.php'><h2>Go Back</h2></a>");
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $emp->name = $_POST["name"];
    $emp->email = $_POST["email"];
    $emp->phone_number = $_POST["phone_number"];
    $emp->dep = $_POST["dep"];
    $emp->salary = $_POST["salary"];

    if ($emp->updateStaff($conn, $_GET['id'])) {
        Url::redirect("sys/staff.php");
    }
}

?>

<?php require "includes/header.php"; ?>
<div class="container">

    <h2 class="form-header">Update Employee's Info</h2>

    <?php if (!empty($emp->errors)) : ?>
        <ul>
            <?php foreach ($emp->errors as $error) : ?>
                <li class="form-errors"><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <?php require "includes/staff-form.php"; ?>
</div>

<?php require "includes/footer.php"; ?>