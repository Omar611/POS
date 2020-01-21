<?php

/**
 * Database clasee
 * 
 * Creates connection to database
 */
class Database
{
    /**
     * Get connection to database
     * 
     * @return object $conn connection to database
     */
    public function getConn()
    {
        $dbhost = 'localhost';
        $dbname = 'database';
        $dbuser = 'omar';
        $dbpassword = '123';

        $dsn = 'mysql:host=' . $dbhost . ';dbname=' . $dbname . ';charset=utf8';

        try {
            $db = new PDO($dsn, $dbuser, $dbpassword);

            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $db;

        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}
