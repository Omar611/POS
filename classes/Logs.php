<?php

/**
 * Logs 
 * Records changes in the stocks
 */
class Logs
{
    /**
     * Update Stock logs for manual changes
     * 
     * @param object $conn Connection to database
     * @param int $id id of product
     * @param int $amount amount of change in the stock
     * @param string $user name of user who made the change
     */
    public static function manualUpdate($conn, $id, $product_name, $amount, $user)
    {
        $sql = "INSERT INTO manual_updates (product_id, product_name, date, amount, user)
                VALUES (:id, :product_name, :date, :amount, :user)";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->bindValue(":product_name", $product_name, PDO::PARAM_STR);
        $stmt->bindValue(":date", date("Y-m-d H:i:s"), PDO::PARAM_STR);
        $stmt->bindValue(":amount", $amount, PDO::PARAM_INT);
        $stmt->bindValue(":user", $user, PDO::PARAM_STR);

        return $stmt->execute();
    }
    /**
     * Show Product
     * Show all avilable products
     * @param object $conn Connection to the database
     * @return array of all products, false otherwise
     */
    public function showLogs($conn)
    {
        $sql = "SELECT *
                FROM manual_updates
                ORDER BY date";

        $results = $conn->query($sql);

        return $results->fetchAll(PDO::FETCH_ASSOC);
    }
}
