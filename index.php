<?php
require "includes/init.php";


?>

<?php require "includes/header.php"; ?>

<div class="container">
    <h1 class="slogan">Let's make your work easier</h1>
    
    <div class="home-btns">

        <div class="home-btns-row">
            <a href="staff.php" class="left-btn btn-main">Staff Information</a>       
            <a href="products.php" class="btn-main">Products & Stock</a>
            <a href="customers.php" class="right-btn btn-main">Customers Information</a>
        </div>
        
        <?php if (Auth::isAdminLoggedIn()) : ?>
            <div class="home-btns-row">
                <a href="sales.php" class="btn-main left-btn">Add Sales Operation(s)</a>
                <a href="stats.php" class="btn-main right-btn">Show Statistics</a>
            </div>
        <?php endif ?>
    </div>
    
</div>
<?php require "includes/footer.php"; ?>