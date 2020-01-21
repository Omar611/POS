<?php

/**
 * Customer Class
 * Contains all the functions related to Customers
 */
class Customer
{
    /**
     * Customer name
     * @var string
     */

    public $name;
    /**
     * Customer Phone number
     * @var string
     */
    public $phone_number;

    /**
     * Customer 2nd Phone number
     * @var string
     */
    public $phone_number_2;

    /**
     * Customer email
     * @var string
     */
    public $email;

    /**
     * Customer address
     * @var string
     */
    public $address;

    /**
     * Customer Sales area
     * @var string
     */
    public $area;


    /**
     * Show Customer
     * Show all Customers
     * @param object $conn Connection to the database
     * @return array of all Customers, false otherwise
     */
    public function showCustomers($conn)
    {
        $sql = "SELECT *
                FROM customers
                ORDER BY id";

        $results = $conn->query($sql);

        return $results->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * Get a singel customer info
     * Show all avilable customers
     * @param object $conn Connection to the database
     * @param int $id customer id
     * @return array of all customers, false otherwise
     */
    public function getcustomer($conn, $id)
    {
        $sql = "SELECT *
                FROM customers
                WHERE id = :id;";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt->fetch();
        } else {
            die("<h1>Error 404 Customer Not Found</h1> <a href='customers.php'><h2>Go Back</h2></a>");
        }
    }
    /**
     * Vaildate inputs in Customer forms
     * @return true on correct validation of Customer's inputs, false otherwise
     */
    public function vaildateCustomer()
    {
        if ($this->name == "" || $this->area == "") {
            $this->errors[] = "Please fill all required field (with the [*] symbole on them)";
        }

        if ($this->phone_number != "" && !is_numeric($this->phone_number)) {
            $this->errors[] = "Please Make sure that Phone number contains numbers only";
        }

        if ($this->phone_number_2 != "" && !is_numeric($this->phone_number_2)) {
            $this->errors[] = "Please Make sure that 2nd Phone number contains numbers only";
        }

        if ($this->email != "" && !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "Please enter a vaild Email";
        }

        return empty($this->errors);
    }

    /**
     * Add Customer
     * Add a new Customer to the database
     * 
     * @param object $conn Connection to the database
     * @return boolean true on success, false otherwise
     */
    public function addCustomer($conn)
    {
        if ($this->vaildateCustomer()) {
            $sql = "INSERT INTO customers (name, phone_number, phone_number_2, email, address, area) 
                    VALUES (:name, :phone_number, :phone_number_2, :email, :address, :area);";

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(":name", $this->name, PDO::PARAM_STR);

            if ($this->phone_number == "") {
                $stmt->bindValue(":phone_number", null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(":phone_number", $this->phone_number, PDO::PARAM_INT);
            }

            if ($this->phone_number_2 == "") {
                $stmt->bindValue(":phone_number_2", null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(":phone_number_2", $this->phone_number_2, PDO::PARAM_INT);
            }
            if ($this->email == "") {
                $stmt->bindValue(":email", null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(":email", $this->email, PDO::PARAM_STR);
            }
            if ($this->address == "") {
                $stmt->bindValue(":address", null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(":address", $this->address, PDO::PARAM_STR);
            }

            $stmt->bindValue(":area", $this->area, PDO::PARAM_STR);

            return $stmt->execute();
        } else {
            return false;
        }
    }
    /**
     * Update Customer
     * Update a new Customer to the database
     * 
     * @param object $conn Connection to the database
     * @param int $id Customer id
     * @return boolean true on success, false otherwise
     */
    public function updateCustomer($conn, $id)
    {
        if ($this->vaildateCustomer()) {
            $sql = "UPDATE customers
                    SET name = :name,
                    phone_number = :phone_number,
                    phone_number_2 =:phone_number_2,
                    email = :email,
                    address = :address,
                    area = :area
                    WHERE id = :id";

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            $stmt->bindValue(":name", $this->name, PDO::PARAM_STR);

            if ($this->phone_number == "") {
                $stmt->bindValue(":phone_number", null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(":phone_number", $this->phone_number, PDO::PARAM_INT);
            }

            if ($this->phone_number_2 == "") {
                $stmt->bindValue(":phone_number_2", null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(":phone_number_2", $this->phone_number_2, PDO::PARAM_INT);
            }
            if ($this->email == "") {
                $stmt->bindValue(":email", null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(":email", $this->email, PDO::PARAM_STR);
            }
            if ($this->address == "") {
                $stmt->bindValue(":address", null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(":address", $this->address, PDO::PARAM_STR);
            }

            $stmt->bindValue(":area", $this->area, PDO::PARAM_STR);

            return $stmt->execute();
        } else {
            return false;
        }
    }
    /**
     * Delete a customer
     * 
     * @param object $conn Connection to the database
     * @param int $id customer id
     * 
     * @return boolean true on success, false otherwise
     */
    public function deleteCustomer($conn, $id)
    {
        $sql = "DELETE FROM customers
                WHERE id = :id";
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
