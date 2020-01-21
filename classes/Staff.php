<?php

/**
 * Staff Class
 * Contains all the functions related to staffs
 */
class Staff
{
    /**
     * staff name
     * @var string
     */
    public $name;

    /**
     * staff email
     * @var string
     */
    public $email;

    /**
     * staff Phone number
     * @var string
     */
    public $phone_number;

    /**
     * staff dep
     * @var string
     */
    public $dep;

    /**
     * staff Sales salary
     * @var string
     */
    public $salary;


    /**
     * Show staff
     * Show all working staffs
     * @param object $conn Connection to the database
     * @return array of all staffs, false otherwise
     */
    public function showStaff($conn)
    {
        $sql = "SELECT *
                FROM staff
                ORDER BY id";

        $results = $conn->query($sql);

        return $results->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * Get a singel staff info
     * Show all avilable staffs
     * @param object $conn Connection to the database
     * @param int $id staff id
     * @return array of all staffs, false otherwise
     */
    public function getStaff($conn, $id)
    {
        $sql = "SELECT *
                FROM staff
                WHERE id = :id;";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt->fetch();
        } else {
            die("<h1>Error 404 staff Not Found</h1> <a href='staff.php'><h2>Go Back</h2></a>");
        }
    }
    /**
     * Vaildate inputs in staff forms
     * @return true on correct validation of staff's inputs, false otherwise
     */
    public function vaildateStaff()
    {
        if ($this->name == "" || $this->dep == "" || $this->salary == "") {
            $this->errors[] = "Please fill all required field (with the [*] symbole on them)";
        }

        if ($this->email != "" && !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "Please enter a vaild Email";
        }

        if ($this->phone_number != "" && !is_numeric($this->phone_number)) {
            $this->errors[] = "Please Make sure that Phone number contains numbers only";
        }

        return empty($this->errors);
    }

    /**
     * Add staff
     * Add a new staff to the database
     * 
     * @param object $conn Connection to the database
     * @return boolean true on success, false otherwise
     */
    public function addstaff($conn)
    {
        if ($this->vaildatestaff()) {
            $sql = "INSERT INTO staff (name, email, phone_number, dep, salary)
                    VALUES (:name, :email, :phone_number, :dep, :salary);";

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(":name", $this->name, PDO::PARAM_STR);

            if ($this->email == "") {
                $stmt->bindValue(":email", null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(":email", $this->email, PDO::PARAM_STR);
            }

            if ($this->phone_number == "") {
                $stmt->bindValue(":phone_number", null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(":phone_number", $this->phone_number, PDO::PARAM_INT);
            }

            $stmt->bindValue(":dep", $this->dep, PDO::PARAM_STR);
            $stmt->bindValue(":salary", $this->salary, PDO::PARAM_INT);

            return $stmt->execute();
        } else {
            return false;
        }
    }
    /**
     * Update staff
     * Update a new staff to the database
     * 
     * @param object $conn Connection to the database
     * @param int $id staff id
     * @return boolean true on success, false otherwise
     */
    public function updateStaff($conn, $id)
    {
        if ($this->vaildatestaff()) {
            $sql = "UPDATE staff
                    SET name = :name,
                    email = :email,
                    phone_number = :phone_number,
                    dep = :dep,
                    salary = :salary
                    WHERE id = :id";

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            $stmt->bindValue(":name", $this->name, PDO::PARAM_STR);

            if ($this->email == "") {
                $stmt->bindValue(":email", null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(":email", $this->email, PDO::PARAM_STR);
            }

            if ($this->phone_number == "") {
                $stmt->bindValue(":phone_number", null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(":phone_number", $this->phone_number, PDO::PARAM_INT);
            }

            $stmt->bindValue(":dep", $this->dep, PDO::PARAM_STR);
            $stmt->bindValue(":salary", $this->salary, PDO::PARAM_STR);

            return $stmt->execute();
        } else {
            return false;
        }
    }
    /**
     * Delete a staff
     * 
     * @param object $conn Connection to the database
     * @param int $id staff id
     * 
     * @return boolean true on success, false otherwise
     */
    public function deleteStaff($conn, $id)
    {
        $sql = "DELETE FROM staff
                WHERE id = :id";
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
