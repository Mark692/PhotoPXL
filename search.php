<?php

session_start();

require_once '.'.DIRECTORY_SEPARATOR.'libs'.DIRECTORY_SEPARATOR.'Smarty.class.php';
$path = "." . DIRECTORY_SEPARATOR . "Utilities" . DIRECTORY_SEPARATOR;
require_once $path . "my_Autoloader.php";
require_once $path . "config.inc.php";

if(!\Control\C_LoginRegistration::isLogged() || \Control\C_LoginRegistration::isBanned()){
    header("Location: /index.php");
    exit();
}

$categories = filter_input(INPUT_POST, "categories", FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
if (is_null($categories) || empty($categories))
{
    header("Location: index.php");
    exit();
}
$cphoto = new \Control\C_Photo();
$cphoto->searchByCategory($categories);

