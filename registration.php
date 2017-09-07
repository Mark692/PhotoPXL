<?php

if(!isset($_SERVER["HTTP_X_FORWARDED_PROTO"]) || $_SERVER["HTTP_X_FORWARDED_PROTO"] != "https"){
    header("Location: https://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"], true, 301);
    exit();
}

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'libs' . DIRECTORY_SEPARATOR . 'Smarty.class.php';

//Include autoloader and other functionalities
$path = "." . DIRECTORY_SEPARATOR . "Utilities" . DIRECTORY_SEPARATOR;
require_once $path . "my_Autoloader.php";
require_once $path . "config.inc.php";

$failed = filter_input(INPUT_GET, "failed");
if ($failed) {
    \Control\C_LoginRegistration::showRegistration(true);
} else {
    \Control\C_LoginRegistration::showRegistration(false);
}