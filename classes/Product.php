<?php

/**
 * Product Class
 * Contains all the functions related to products
 */
class Product
{

    /**
     * Product name
     * @var string
     */
    public $name;

    /**
     * Product description
     * @var string
     */
    public $description;

    /**
     * Product price
     * @var int
     */
    public $price;

    /**
     * Product cost
     * @var int
     */
    public $cost;

    /**
     * Maximum allowed discount per sale
     * @var int
     */
    public $max_discount;

    /**
     * Avilable Stock of the product
     * @var int
     */
    public $avilable_stock;

    /**
     * Errors in inputs
     * @var array
     */
    public $errors = [];

    /**
     * Show Product
     * Show all avilable products
     * @param object $conn Connection to the database
     * @return array of all products, false otherwise
     */
    public function showProducts($conn)
    {
        $sql = "SELECT *
                FROM products
                ORDER BY id";

        $results = $conn->query($sql);

        return $results->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * Get a singel Product info
     * Show all avilable products
     * @param object $conn Connection to the database
     * @param int $id Product id
     * @return array of all products, false otherwise
     */
    public function getProduct($conn, $id)
    {
        $sql = "SELECT *
                FROM products
                WHERE id = :id;";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return $stmt->fetch();
        } else {
            die("<h1>Error 404 Product Not Found</h1> <a href='products.php'><h2>Go Back</h2></a>");
        }
    }

    /**
     * Vaildate inputs in Product forms
     * @return true on correct validation of product's inputs, false otherwise
     */
    public function vaildateProduct()
    {
        if ($this->name == "" || $this->price == "" || $this->cost == "" || $this->max_discount == "") {
            $this->errors[] = "Please fill all required field (with the [*] symbole on them)";
        }

        if (!is_numeric($this->price)) {
            $this->errors[] = "Please Make sure that Price is a number";
        }

        if (!is_numeric($this->cost)) {
            $this->errors[] = "Please Make sure that Cost is a number";
        }

        if (!is_numeric($this->max_discount)) {
            $this->errors[] = "Please Make sure that Maximum allowed discount is a number without the '%' symbole";
        }

        if ($this->avilable_stock) {
            if (!is_numeric($this->avilable_stock)) {
                $this->errors[] = "Please Make sure that Stock is a number";
            }
        }

        if ($this->avilable_stock < 0) {
            $this->errors[] = "Stock can't be negative";
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
    public function addProduct($conn)
    {
        if ($this->vaildateProduct()) {
            $sql = "INSERT INTO products (name, description, price, cost, max_discount, avilable_stock) 
                    VALUES (:name, :description, :price, :cost, :max_discount, :avilable_stock);";

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(":name", $this->name, PDO::PARAM_STR);

            if ($this->description == "") {
                $stmt->bindValue(":description", null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(":description", $this->description, PDO::PARAM_STR);
            }
            $stmt->bindValue(":price", $this->price, PDO::PARAM_STR);
            $stmt->bindValue(":cost", $this->cost, PDO::PARAM_STR);
            $stmt->bindValue(":max_discount", $this->max_discount, PDO::PARAM_STR);

            if ($this->avilable_stock == "") {
                $stmt->bindValue(":avilable_stock", 0, PDO::PARAM_STR);
            } else {
                $stmt->bindValue(":avilable_stock", $this->avilable_stock, PDO::PARAM_STR);
            }

            return $stmt->execute();
        } else {
            return false;
        }
    }
    /**
     * Update Product
     * Update a new product to the database
     * 
     * @param object $conn Connection to the database
     * @param int $id Product id
     * @return boolean true on success, false otherwise
     */
    public function updateProduct($conn, $id)
    {
        if ($this->vaildateProduct()) {
            $sql = "UPDATE products
                    SET name = :name,
                        description = :description,
                        price = :price,
                        cost = :cost,
                        max_discount = :max_discount,
                        avilable_stock = :avilable_stock
                    WHERE id = :id";

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(":id", $id, PDO::PARAM_STR);
            $stmt->bindValue(":name", $this->name, PDO::PARAM_STR);

            if ($this->description == "") {
                $stmt->bindValue(":description", null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(":description", $this->description, PDO::PARAM_STR);
            }

            $stmt->bindValue(":price", $this->price, PDO::PARAM_STR);
            $stmt->bindValue(":cost", $this->cost, PDO::PARAM_STR);
            $stmt->bindValue(":max_discount", $this->max_discount, PDO::PARAM_STR);

            if ($this->avilable_stock == "") {
                $stmt->bindValue(":avilable_stock", 0, PDO::PARAM_STR);
            } else {
                $stmt->bindValue(":avilable_stock", $this->avilable_stock, PDO::PARAM_STR);
            }

            return $stmt->execute();
        } else {
            return false;
        }
    }
    /**
     * Update Stock amount
     * Update a product's stock to the database
     * 
     * @param object $conn Connection to the database
     * @param int $id Product id
     * @param int $edited_amount Amount increased or decreased in stock
     * @return boolean true on success, false otherwise
     */
    public function updateStock($conn, $id, $edited_amount)
    {
            $sql = "UPDATE products
                    SET avilable_stock = :avilable_stock
                    WHERE id = :id";

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(":id", $id, PDO::PARAM_STR);
            
            $this->avilable_stock += $edited_amount;

            $stmt->bindValue(":avilable_stock", $this->avilable_stock, PDO::PARAM_STR);

            return $stmt->execute();
    }

    /**
     * Vaildate inputs in stock forms
     * @return true on correct validation of stock inputs, false otherwise
     */
    public function validateStock()
    {
        if ($this->quantity == "") {
            $this->errors[] = "Please fill all required field (with the [*] symbole on them)";
        }

        if (!is_numeric($this->quantity)) {
            $this->errors[] = "Please Make sure that Price is a number";
        }

        return empty($this->errors);
    }
    /**
     * Delete a Product
     * 
     * @param object $conn Connection to the database
     * @param int $id Product id
     * 
     * @return boolean true on success, false otherwise
     */
    public function deleteProduct($conn, $id)
    {
        $sql = "DELETE FROM products
                WHERE id = :id";
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(":id", $id, PDO::PARAM_STR);

        return $stmt->execute();
    }
}
