<?php
require "includes/init.php";

$db = new Database;
$conn = $db->getConn();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (Auth::validateAdminLogin($conn, $_POST['username'], $_POST['password'])) {
        session_regenerate_id(true);
        $_SESSION['isAdmin'] = true;
        $_SESSION['user'] = $_POST['username'];
        Url::redirect("sys/index.php");
    } else if (Auth::validateGuestLogin($conn, $_POST['username'], $_POST['password'])) {
        session_regenerate_id(true);
        $_SESSION['isGuest'] = true;
        $_SESSION['user'] = $_POST['username'];
        Url::redirect("sys/index.php");
    } else {
        $error = 'User-Name or Password is Not Correct !!!';
    }
}
?>

<?php require "includes/header.php"; ?>
<div class="container">

    <?php if (Auth::isLoggedIn()) : ?>
        <h2 class="form-header">To Access Stats & Edite Privileges Please Log In as an Admin</h2>
    <?php else : ?>
        <h2 class="form-header">To Access Any Information on this website Please Log In !!</h2>
    <?php endif ?>

    <form action="" method="post">
        <div class="form-container">
            <table class="form-table">
                <tr>
                    <th><label for="username">User Name</label></th>
                    <td><input type="text" name="username" placeholder="User Name" class="input-filed"></td>
                </tr>
                <tr>
                    <th><label for="password">Password</label></th>
                    <td><input type="password" name="password" placeholder="Password" class="input-filed"></td>
                </tr>
            </table>
            <button type="submit" class="btn-sumbit">Submit</button>
        </div>
    </form>

    <?php if (isset($error)) : ?>
        <p class="form-errors"><?= $error ?></p>
    <?php endif; ?>
</div>
<?php require "includes/footer.php"; ?>