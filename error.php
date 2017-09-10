<?php

use Entity\E_Photo;
use Control\C_LoginRegistration;
use View\V_Home;

session_start();

require_once '.' . DIRECTORY_SEPARATOR . 'libs' . DIRECTORY_SEPARATOR . 'Smarty.class.php';
$path = "." . DIRECTORY_SEPARATOR . "Utilities" . DIRECTORY_SEPARATOR;
require_once $path . "my_Autoloader.php";
require_once $path . "config.inc.php";

if(!\Control\C_LoginRegistration::isLogged()){
    header("Location: /index.php");
    exit();
}

V_Home::error(E_Photo::get_MostLiked(C_LoginRegistration::getUsername(), C_LoginRegistration::getRole()), C_LoginRegistration::getUsername());
