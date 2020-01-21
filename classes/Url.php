<?php
/**
 * Class URL
 * 
 * Respons method
 */
class Url
{
    /**
     * Reditect
     * Rredirects client to certain path
     * 
     * @param string $path Path to redirect to
     */
    public static function redirect($path)
    {
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off'){
            $protocol = "https";
        }else {
            $protocol = 'http';
        }
        header("Location: $protocol://" . $_SERVER['HTTP_HOST']. "/". $path);
    }
}