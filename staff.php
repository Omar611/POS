<?php
require "includes/init.php";

$db = new Database;
$conn = $db->getConn();

$staff = new Staff;

$staff = $staff->showStaff($conn);

?>

<?php require "includes/header.php"; ?>
<div class="container">

    <h1 class="form-header">Staff Information</h1>

    <?php if (Auth::isAdminLoggedIn()) : ?>
        <div class="content-btns">
            <a href="add-staff.php" class="btn-sec">Add Staff Member</a>
        </div>
    <?php endif ?>
    <div class="table-container">
        <table class="info_table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Employee Name</th>
                    <th>Email</th>
                    <th>Phone number</th>
                    <th>Department</th>
                    <?php if (Auth::isAdminLoggedIn()) : ?>
                        <th>Salary</th>
                    <?php endif ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($staff as $emp) : ?>
                    <tr>
                        <td> <?= $emp['id'] ?> </td>
                        <td> <a href="staff-stats.php?id=<?= $emp['id'] ?>" class="btn-table"><?= $emp['name'] ?></a> </td>
                        <td> <?= ($emp['email'] == null) ? "N/A" : $emp['email'] ?> </td>
                        <td> <?= ($emp['phone_number'] == null) ? "N/A" : $emp['phone_number'] ?> </td>
                        <td> <?= $emp['dep'] ?> </td>
                        <?php if (Auth::isAdminLoggedIn()) : ?>
                            <td> <?= $emp['salary'] ?> $</td>
                            <th><a href="update-staff.php?id=<?= $emp['id'] ?>" class="btn-table">Update Employee's info</a></th>
                            <th><a href="delete-staff.php?id=<?= $emp['id'] ?>" class="btn-table-sec">Delete Employee</a></th>

                            <?php if ($emp['dep'] == 'Sales') : ?>
                                <th><a href="staff-stats.php?id=<?= $emp['id'] ?>" class="btn-table">Show Sales Stats.</a></th>
                            <?php endif ?>

                        <?php endif ?>

                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </div>
</div>

<?php require "includes/footer.php"; ?>