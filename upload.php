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

\View\V_Foto::showUploadPhoto(\Control\C_LoginRegistration::getUsername());