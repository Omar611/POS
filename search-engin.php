<?php

require "includes/init.php";

$db = new Database;
$conn = $db->getConn();

$product = new Product;
$staff = new Staff;
$customer = new Customer;

$productsInfo = $product->showProducts($conn);
$staffInfo = $staff->showStaff($conn);
$customerInfo = $customer->showCustomers($conn);

$response = [];

if (isset($_POST['search'])) {

    $search_text = $_POST['search'];

    $response = [];


    foreach ($productsInfo as $product) {
        if (strpos(strtolower($product["name"]), strtolower($search_text)) !== false) {

            $response[] = '<li><a href="product-stats.php?id=' . $product["id"] . '"> Product :' . $product["name"] . '</a></li>';
        }
    }

    foreach ($staffInfo as $staff) {
        if ($staff["dep"] = "Sales") {
            if (strpos(strtolower($staff["name"]), strtolower($search_text)) !== false) {

                $response[] = '<li><a href="staff-stats.php?id=' . $staff["id"] . '"> Staff :' . $staff["name"] . '</a></li>';
            }
        }
    }

    foreach ($customerInfo as $customer) {
        if (strpos(strtolower($customer["name"]), strtolower($search_text)) !== false) {

            $response[] = '<li><a href="customer-stats.php?id=' . $customer["id"] . '"> Customer :' . $customer["name"] . '</a></li>';
        }
    }


    echo json_encode($response);
}
