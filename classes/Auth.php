<?php

/**
 * Authentication Class
 * All methods for login and Access Authorization
 */
class Auth
{
    /**
     * Varify user info
     * 
     * @param object $conn Connection to database
     * @param string $username User name
     * @param string $password Password
     * 
     * @return boolean true on success, flase otherwise
     */
    public static function validateGuestLogin($conn, $username, $password)
    {
        $sql = "SELECT *
                FROM users
                WHERE username = :username";
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(":username", $username, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result['password'] == $password) {
                return $result['type'] == 'guest';
            }
        } else {
            return false;
        }
    }
    /**
     * Varify user info
     * 
     * @param object $conn Connection to database
     * @param string $username User name
     * @param string $password Password
     * 
     * @return boolean true on success, flase otherwise
     */
    public static function validateAdminLogin($conn, $username, $password)
    {
        $sql = "SELECT *
                FROM users
                WHERE username = :username";
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(":username", $username, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result['password'] == $password) {
                return $result['type'] == 'admin';
            }
        } else {
            return false;
        }
    }
    /**
     * Require Admin Log In
     * Kill pages when non admin users try to access them
     * 
     * @return void
     */
    public static function requireAdminLogIn()
    {
        if (!isset($_SESSION["isAdmin"]) || $_SESSION["isAdmin"] != true) {
            die("<h1>Error 403 Forbidden Access</h1>
            <p>If you are an Admin Please <a href='login.php'>Log In</a>,
             otherwise <a href='index.php'>Go back to Home Page</a></p>");
        }
    }
    /**
     * Require Log In
     * Kill pages when non admin users try to access them
     * 
     * @return void
     */
    public static function requireLogIn()
    {
        if (!isset($_SESSION["isGuest"]) && !isset($_SESSION["isAdmin"])) {
            die(Url::redirect("sys/login.php"));
        } else if (isset($_SESSION["isGuest"]) && $_SESSION["isGuest"] != true && $_SESSION["isAdmin"] != true) {
            // die("<h1>Forbidden Access</h1>
            // <p>Please <a href='login.php'>Log In</a>");
            die(Url::redirect("sys/login.php"));
        }
    }

    /**
     * Is Admin Logged In
     * Check if user in logged in to show or hide contents
     * 
     * @return boolean true if logged in, flase otherwise
     */
    public static function isAdminLoggedIn()
    {
        return isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == true;
    }
    /**
     * Is Logged In
     * Check if user in logged in to show or hide contents
     * 
     * @return boolean true if logged in, flase otherwise
     */
    public static function isLoggedIn()
    {
        return isset($_SESSION["isGuest"]) && $_SESSION["isGuest"] == true;
    }
}
