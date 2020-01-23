<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <title>Cloud Trade Manager</title>
</head>

<body>
    <div class="navbar">
        <?php if ($_SERVER["SCRIPT_NAME"] != "/sys/index.php") : ?>
            <div class="top-bar">
                <div class="burger">
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                </div>
            <?php endif ?>

            <h1 class="logo"><a href="index.php">Cloud Trading Manager</a> </h1>

            <?php if ($_SERVER["SCRIPT_NAME"] != "/sys/login.php") : ?>

                <?php if (Auth::isAdminLoggedIn()) : ?>

                    <p class="welcom-msg">Welcom Admin <strong><?= ucwords($_SESSION['user']) ?></strong>. You are logged in ... <a href="logout.php">Log Out</a> ?</p>
                <?php elseif (Auth::isLoggedIn()) : ?>

                    <p class="welcom-msg">Welcom <strong><?= ucwords($_SESSION['user']) ?></strong>. You are logged in ... <a href="logout.php">Log Out</a> ?</p>
                <?php endif ?>
            <?php endif ?>
            </div>


            <?php if ($_SERVER["SCRIPT_NAME"] != "/sys/index.php") : ?>

                <ul class="nav-buttons hide">
                    <li>
                        <a href="staff.php" class="btn-main">Staff Information</a>
                    </li>
                    <li>
                        <a href="products.php" class="btn-main">Products & Stock</a>
                    </li>
                    <li>
                        <a href="customers.php" class="btn-main">Customers Information</a>
                    </li>
                    <?php if (Auth::isAdminLoggedIn()) : ?>
                        <li>
                            <a href="sales.php" class="btn-main">Add Sales Operation(s)</a>
                        </li>
                        <li>
                            <a href="stats.php" class="btn-main">Show Statistics</a>
                        </li>
                    <?php endif ?>
                </ul>

            <?php endif ?>

    </div>