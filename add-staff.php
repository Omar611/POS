<?php
require "includes/init.php";

Auth::requireAdminLogIn();

$db = new Database;
$conn = $db->getConn();

$emp = new Staff;

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $emp->name = $_POST["name"];
    $emp->email = $_POST["email"];
    $emp->phone_number = $_POST["phone_number"];
    $emp->dep = $_POST["dep"];
    $emp->salary = $_POST["salary"];


    if ($emp->addStaff($conn)) {
        $id = $conn->lastInsertId();
        Url::redirect("sys/staff.php");
    }
}

?>

<?php require "includes/header.php"; ?>
<div class="container">

    <h2 class="form-header">Add New Product</h2>

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