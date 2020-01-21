<?php
require "includes/init.php";

$db = new Database;
$conn = $db->getConn();

Auth::requireAdminLogIn();

$logs = new Logs;

$logs = $logs->showLogs($conn);

?>

<?php require "includes/header.php"; ?>

<div class="container">
    <h2 class="form-header">Stock Edite History</h2>

    <table class="info_table">
        <thead>
            <tr>
                <th>Edite Date & Time</th>
                <th>ID</th>
                <th>Product Name</th>
                <th>Amount</th>
                <th>Edited by</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($logs as $log) : ?>
                <tr>
                    <td> <?= $log['date'] ?> </td>
                    <td> <?= $log['product_id'] ?> </td>
                    <td> <?= $log['product_name'] ?> </td>
                    <td> <?= $log['amount'] ?></td>
                    <td> <?= ucwords($log['user']) ?> </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
</div>
<?php require "includes/footer.php"; ?>