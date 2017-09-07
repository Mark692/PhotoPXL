<?php

session_start();

require_once '.'.DIRECTORY_SEPARATOR.'libs'.DIRECTORY_SEPARATOR.'Smarty.class.php';
$path = "." . DIRECTORY_SEPARATOR . "Utilities" . DIRECTORY_SEPARATOR;
require_once $path . "my_Autoloader.php";
require_once $path . "config.inc.php";

$username = \Control\C_LoginRegistration::getUsername();
if (\Entity\E_User::get_DB_Role($username) == \Utilities\Roles::STANDARD){
    \Entity\E_User_Admin::change_role($username, \Utilities\Roles::PRO);
}
header("Location: index.php");