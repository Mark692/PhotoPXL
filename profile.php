<?php
session_start();

require_once '.'.DIRECTORY_SEPARATOR.'libs'.DIRECTORY_SEPARATOR.'Smarty.class.php';
$path = "." . DIRECTORY_SEPARATOR . "Utilities" . DIRECTORY_SEPARATOR;
require_once $path . "my_Autoloader.php";
require_once $path . "config.inc.php";

\View\V_Profilo::home(\Control\C_LoginRegistration::getUsername(), \Entity\E_User::get_UserDetails(\Control\C_LoginRegistration::getUsername()), \Entity\E_Photo::get_By_User(\Control\C_LoginRegistration::getUsername(), \Control\C_LoginRegistration::getUsername(), \Entity\E_User::get_DB_Role(\Control\C_LoginRegistration::getUsername())));
