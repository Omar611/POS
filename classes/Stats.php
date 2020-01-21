<?php

/**
 * Statistics class
 * Contains all methods to show stats on Sales and Products traffic
 */
class Stats
{
    /**
     * Get total Revenue earend from each customer.
     * 
     * @param object $conn Connection to the database
     * @param string $start_period Starting date of filter period
     * @param string $end_period Ending date of filter period
     */
    public function customersPurchases($conn, $start_period, $end_period)
    {
        $sql = 'SELECT customer_id AS id, customers.name AS name , SUM(revenue) AS TotalRevenue , sales.price AS TotalPurchases, sales.discount AS discount
                FROM sales
                JOIN customers
                on customers.id = customer_id
                WHERE date >= :start_period
                AND date <= :end_period
                GROUP BY customer_id
                ORDER BY SUM(revenue) DESC';

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(":start_period", $start_period, PDO::PARAM_STR);
        $stmt->bindValue(":end_period", $end_period, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }
    /**
     * Get total Revenue earend by each sales Employee.
     * 
     * @param object $conn Connection to the database
     * @param string $start_period Starting date of filter period
     * @param string $end_period Ending date of filter period
     */
    public function staffRevenue($conn, $start_period, $end_period)
    {
        $sql = 'SELECT staff_id AS id, staff.name AS name , SUM(revenue) AS TotalRevenue , sales.price AS TotalPurchases, sales.discount AS discount
                FROM sales
                JOIN staff
                on staff.id = staff_id
                WHERE date >= :start_period
                AND date <= :end_period
                GROUP BY staff_id
                ORDER BY SUM(revenue) DESC';

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(":start_period", $start_period, PDO::PARAM_STR);
        $stmt->bindValue(":end_period", $end_period, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }
    /**
     * Get total Revenue earend by each sales Employee.
     * 
     * @param object $conn Connection to the database
     * @param string $start_period Starting date of filter period
     * @param string $end_period Ending date of filter period
     */
    public function productsRevenue($conn, $start_period, $end_period)
    {
        $sql = 'SELECT product_id AS id, products.name AS name , SUM(revenue) AS TotalRevenue , sales.price AS TotalPurchases, sales.discount AS discount, sales.quantity As SoldUints
                FROM sales
                JOIN products
                on products.id = product_id
                WHERE date >= :start_period
                AND date <= :end_period
                GROUP BY product_id
                ORDER BY SUM(revenue) DESC';

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(":start_period", $start_period, PDO::PARAM_STR);
        $stmt->bindValue(":end_period", $end_period, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }
    /**
     * Get total return purchase stats for a single customer
     * 
     * @param object $conn Connection to the database
     * @param int $id customer id
     */
    public function customerTopProducts($conn, $id, $start_period, $end_period)
    {
        $sql = 'SELECT customer_id, product_id , products.name , sum(quantity) AS quantity, sum(revenue)AS TotalRevenue 
                FROM sales 
                JOIN products 
                ON product_id = products.id 
                WHERE customer_id = :id
                AND date >= :start_period
                AND date <= :end_period
                GROUP BY product_id
                ORDER BY TotalRevenue DESC';

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->bindValue(":start_period", $start_period, PDO::PARAM_STR);
        $stmt->bindValue(":end_period", $end_period, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }
    /**
     * Get total return Sales Employees stats for a single customer
     * 
     * @param object $conn Connection to the database
     * @param int $id customer id
     */
    public function customerTopSalesMen($conn, $id, $start_period, $end_period)
    {
        $sql = 'SELECT customer_id, staff_id , staff.name , sum(quantity) AS quantity, sum(revenue)AS TotalRevenue 
                FROM sales 
                JOIN staff 
                ON staff_id = staff.id 
                WHERE customer_id = :id
                AND date >= :start_period
                AND date <= :end_period
                GROUP BY staff_id
                ORDER BY TotalRevenue DESC';

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->bindValue(":start_period", $start_period, PDO::PARAM_STR);
        $stmt->bindValue(":end_period", $end_period, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }
    /**
     * Get total return Sales men stats for a single product
     * 
     * @param object $conn Connection to the database
     * @param int $id product id
     */
    public function productTopSalesMen($conn, $id, $start_period, $end_period)
    {
        $sql = 'SELECT staff_id, staff.name, sum(quantity) AS quantity, sum(revenue)AS TotalRevenue 
                FROM sales 
                JOIN staff 
                ON staff_id = staff.id 
                WHERE product_id = :id
                AND date >= :start_period
                AND date <= :end_period
                GROUP BY staff_id
                ORDER BY TotalRevenue DESC';

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->bindValue(":start_period", $start_period, PDO::PARAM_STR);
        $stmt->bindValue(":end_period", $end_period, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }
    /**
     * Get total return Customers purchase stats for a single product
     * 
     * @param object $conn Connection to the database
     * @param int $id product id
     */
    public function productTopCustomers($conn, $id, $start_period, $end_period)
    {
        $sql = 'SELECT customer_id, customers.name, sum(quantity) AS quantity, sum(revenue)AS TotalRevenue 
                FROM sales 
                JOIN customers 
                ON customer_id = customers.id 
                WHERE product_id = :id
                AND date >= :start_period
                AND date <= :end_period
                GROUP BY customer_id
                ORDER BY TotalRevenue DESC';

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->bindValue(":start_period", $start_period, PDO::PARAM_STR);
        $stmt->bindValue(":end_period", $end_period, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }
    /**
     * Get total return selling stats for a single product
     * 
     * @param object $conn Connection to the database
     * @param int $id product id
     */
    public function staffTopProduct($conn, $id, $start_period, $end_period)
    {
        $sql = 'SELECT product_id, products.name, sum(quantity) AS quantity, sum(revenue)AS TotalRevenue 
                FROM sales 
                JOIN products
                ON product_id = products.id 
                WHERE staff_id = :id
                AND date >= :start_period
                AND date <= :end_period
                GROUP BY product_id
                ORDER BY TotalRevenue DESC';

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->bindValue(":start_period", $start_period, PDO::PARAM_STR);
        $stmt->bindValue(":end_period", $end_period, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }
    /**
     * Get total return purchase stats for a single product
     * 
     * @param object $conn Connection to the database
     * @param int $id product id
     */
    public function staffTopCustomers($conn, $id, $start_period, $end_period)
    {
        $sql = 'SELECT customer_id, customers.name, sum(quantity) AS quantity, sum(revenue)AS TotalRevenue 
                FROM sales 
                JOIN customers 
                ON customer_id = customers.id 
                WHERE staff_id = :id
                AND date >= :start_period
                AND date <= :end_period
                GROUP BY customer_id
                ORDER BY TotalRevenue DESC';

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->bindValue(":start_period", $start_period, PDO::PARAM_STR);
        $stmt->bindValue(":end_period", $end_period, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }
}
