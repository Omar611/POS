<?php

spl_autoload_register(function($class){
    require dirname(__DIR__) . "/classes/{$class}.php";
});
session_start();

if ($_SERVER["SCRIPT_NAME"] != "/sys/login.php"){
    Auth::requireLogIn();
}