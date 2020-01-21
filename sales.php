<?php
require "includes/init.php";
Auth::requireAdminLogIn();

$db = new Database;
$conn = $db->getConn();

$product = new Product;
$sales_Op = new Sales;
$staff = new Staff;
$customer = new Customer;

$employees = $staff->showStaff($conn);
$customers = $customer->showCustomers($conn);
$products = $product->showProducts($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $productInfo = $product->getProduct($conn, $_POST['product_id']);
    $emp_info = $staff->getStaff($conn, $_POST['emp_id']);
    $customer_info = $customer->getcustomer($conn, $_POST['customer_id']);

    $sales_Op->date = $_POST['date'];
    $sales_Op->emp_id = $_POST['emp_id'];
    $sales_Op->customer_id = $_POST['customer_id'];
    $sales_Op->product_id = $_POST['product_id'];
    $sales_Op->quantity = $_POST['quantity'];
    $sales_Op->cost_of_product = $productInfo['cost'];
    $sales_Op->price = $productInfo['price'];
    $sales_Op->discount = ($_POST['discount'] == "") ? 0 : $_POST['discount'];
    $sales_Op->max_discount = $productInfo['max_discount'];
    $sales_Op->revenue = (($sales_Op->discount > 0) ? ($sales_Op->price * (1 - ($sales_Op->discount / 100))) : $sales_Op->price) - $sales_Op->cost_of_product;
    $sales_Op->input_by = $_SESSION['user'];
    $sales_Op->notes = $_POST['notes'];
    $sales_Op->avilable_stock = $productInfo['avilable_stock'];

    if (!isset($customer_info['name'])) {
        $sales_Op->errors[] = "Please enter a vaild customer ID";
    }
    if (!isset($emp_info['name'])) {
        $sales_Op->errors[] = "Please enter a vaild Employee ID";
    } elseif ($emp_info['dep'] != "Sales") {
        $sales_Op->errors[] = "Current Employee is not in Sales Dep. You enteret the ID of <strong>{$emp_info['name']}</strong> from <strong>{$emp_info['dep']}</strong> Dep.";
    }
    if (!isset($productInfo['name'])) {
        $sales_Op->errors[] = "Please enter a vaild Product ID";
    }

    if ($sales_Op->addSalesOp($conn)) {

        $product->avilable_stock = $productInfo['avilable_stock'];
        //selling quantity in negative to decrease stock
        if ($product->updateStock($conn, $sales_Op->product_id, -$sales_Op->quantity)) {
            echo '  <div class="popup">
                        <div class="popup-msg">
                           <h3 class="form-header">Sale Operation added</h3>
                            <div class="popup-btns">
                              <a href="#" id="addNew">Add New</a> <a href="index.php">Go Home</a>
                            </div>
                        </div>
                    </div>';
        }
    }
}

?>

<?php require "includes/header.php"; ?>
<div class="container">

    <h3 class="form-header">Add a New Sales Operation</h3>

    <?php if (!empty($sales_Op->errors)) : ?>
        <ul>
            <?php foreach ($sales_Op->errors as $error) : ?>
                <li class="form-errors"><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>


    <form method="POST">
        <div class="form-container">

            <table class="form-table" id="sales-form">
                <tr>
                    <th>
                        <label for="date">Date :*</label>
                    </th>
                    <td>
                        <input type="date" id="date" name="date" value="<?= htmlspecialchars($sales_Op->date); ?>" class="input-filed">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="customer_id">Customer:*</label>
                    </th>
                    <td>
                        <!-- <input type="number" id="customer_id" name="customer_id" value="<//?= htmlspecialchars($sales_Op->customer_id); ?>"> -->
                        <select name="customer_id" id="customer_id" class="input-filed">
                            <option value="-1">-- Select Customer --</option>
                            <?php foreach ($customers as $buyer) : ?>
                                <option value="<?= $buyer['id'] ?>"><?= $buyer['id'] . "- " . $buyer['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="emp_id">Sales Employee:*</label>
                    </th>
                    <td>
                        <!-- <input type="number" id="emp_id" name="emp_id" value="<//?= htmlspecialchars($sales_Op->emp_id); ?>"> -->
                        <select name="emp_id" id="emp_id" class="input-filed">
                            <option value="-1">-- Select Sales Employee --</option>
                            <?php foreach ($employees as $emp) : ?>
                                <?php if ($emp['dep'] == 'Sales') : ?>
                                    <option value="<?= $emp['id'] ?>"><?= $emp['id'] . "- " . $emp['name'] ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="product_id">Product:*</label>
                    </th>
                    <td>
                        <!-- <input type="number" id="product_id" name="product_id" value="<//?= htmlspecialchars($sales_Op->product_id); ?>"> -->
                        <select name="product_id" id="product_id" class="input-filed">
                            <option value="-1">-- Select Product --</option>
                            <?php foreach ($products as $product) : ?>
                                <option value="<?= $product['id'] ?>"><?= $product['id'] . "- " . $product['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="quantity">Quantity Sold :*</label>
                    </th>
                    <td>
                        <input type="number" id="quantity" name="quantity" value="<?= htmlspecialchars($sales_Op->quantity); ?>" class="input-filed">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="discount">Discount :</label>
                    </th>
                    <td>
                        <input type="number" step="0.01" id="discount" name="discount" value="<?= htmlspecialchars($sales_Op->discount); ?>" class="input-filed">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="notes">Notes on this Operation :</label>
                    </th>
                    <td>
                        <textarea name="notes" id="notes" cols="35" rows="7" class="input-filed"><?= htmlspecialchars($sales_Op->notes); ?></textarea>
                    </td>
                </tr>

            </table>

            <button type="submit" class="btn-sumbit" id="addSalesBtn">Submit</button>
        </div>
    </form>
</div>

<?php require "includes/footer.php"; ?>