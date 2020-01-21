<?php

/**
 * Sales class
 * Includes all the functions related to sales operations
 */
class Sales
{
    /**
     * Date of Sales Operation
     * @var string
     */
    public $date;

    /**
     * Employee's ID
     * @var int
     */
    public $emp_id;

    /**
     * Customer ID
     * @var int
     */
    public $customer_id;

    /**
     * Sold Product ID
     * @var int
     */
    public $product_id;

    /**
     * Quantity sold
     * @var int
     */
    public $quantity;

    /**
     * Cost of Sold Product
     * @var int
     */
    public $cost_of_product;

    /**
     * Product selling price
     * @var int
     */
    public $price;

    /**
     * Discount on this selling operaion
     * @var int
     */
    public $discount;

    /**
     * Maximum allowed discount
     * @var int
     */
    public $max_discount;

    /**
     * Revenue on this selling operation
     * @var int
     */
    public $revenue;

    /**
     * Inputer name (Admin name)
     * @var int
     */
    public $input_by;

    /**
     * Notes on this selling operaion
     * @var string
     */
    public $notes;

    /**
     * Avilabe stock of the product
     * @var int
     */
    public $avilable_stock;

    /**
     * Errors in inputs
     * @var array
     */
    public $errors = [];

    /**
     * Vaildate inputs in Selling forms
     * @return true on correct validation of Sale's inputs, false otherwise
     */
    public function vaildateSales()
    {
        if ($this->date == "" || $this->customer_id == "" || $this->emp_id == "" || $this->product_id == "" || $this->quantity == "") {
            $this->errors[] = "Please fill all required field (with the [*] symbole on them)";
        }

        if (!is_numeric($this->customer_id)) {
            $this->errors[] = "Please Make sure that customer id is a number";
        }

        if (!is_numeric($this->emp_id)) {
            $this->errors[] = "Please Make sure that Employee's id is a number";
        }

        if (!is_numeric($this->product_id)) {
            $this->errors[] = "Please Make sure that product id is a number";
        }

        if (!is_numeric($this->quantity)) {
            $this->errors[] = "Please Make sure that quantity is a number";
        }
        //check if product existes first
        if ($this->avilable_stock) {

            if ($this->avilable_stock < $this->quantity) {
                $this->errors[] = "Quantity sold cann't be more than avilable stock. Your avilable stock is {$this->avilable_stock}";
            }

            if ($this->discount) {
                if (!is_numeric($this->discount)) {
                    $this->errors[] = "Please Make sure that Discount is a number";
                }
            }

            if ($this->discount > $this->max_discount) {
                $this->errors[] = "Cuurent discount is more than maximum allowed discount {$this->max_discount}% please decrease the discount or edit maximum allowed discount of this product";
            }
        }


        return empty($this->errors);
    }

    /**
     * Add Product
     * Add a new product to the database
     * 
     * @param object $conn Connection to the database
     * @return boolean true on success, false otherwise
     */
    public function addSalesOp($conn)
    {
        if ($this->vaildateSales()) {
            $sql = "INSERT INTO sales (date, staff_id, customer_id, product_id, quantity, cost_of_product, price, discount, revenue, input_by, notes) 
                    VALUES (:date, :emp_id, :customer_id, :product_id, :quantity, :cost_of_product, :price, :discount, :revenue, :input_by, :notes);";

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(":date", $this->date, PDO::PARAM_STR);
            $stmt->bindValue(":emp_id", $this->emp_id, PDO::PARAM_STR);
            $stmt->bindValue(":customer_id", $this->customer_id, PDO::PARAM_STR);
            $stmt->bindValue(":product_id", $this->product_id, PDO::PARAM_STR);
            $stmt->bindValue(":quantity", $this->quantity, PDO::PARAM_STR);
            $stmt->bindValue(":cost_of_product", $this->cost_of_product, PDO::PARAM_STR);
            $stmt->bindValue(":price", $this->price, PDO::PARAM_STR);
            $stmt->bindValue(":discount", $this->discount, PDO::PARAM_STR);
            $stmt->bindValue(":revenue", $this->revenue, PDO::PARAM_STR);
            $stmt->bindValue(":input_by", $this->input_by, PDO::PARAM_STR);
            $stmt->bindValue(":notes", $this->notes, PDO::PARAM_STR);

            return $stmt->execute();
        } else {
            return false;
        }
    }
}
