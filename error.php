<?php

use Entity\E_Photo;
use Control\C_LoginRegistration;
use View\V_Home;

session_start();

require_once '.' . DIRECTORY_SEPARATOR . 'libs' . DIRECTORY_SEPARATOR . 'Smarty.class.php';
$path = "." . DIRECTORY_SEPARATOR . "Utilities" . DIRECTORY_SEPARATOR;
require_once $path . "my_Autoloader.php";
require_once $path . "config.inc.php";

if(!C_LoginRegistration::isLogged() || \C_LoginRegistration::isBanned()){
    header("Location: /index.php");
    exit();
}
$username = C_LoginRegistration::getUsername();
$role = C_LoginRegistration::getRole();
$mostLiked = E_Photo::get_MostLiked($username, $role);
V_Home::error($mostLiked, $username);
