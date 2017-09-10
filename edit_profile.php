<?php

session_start();

require_once '.' . DIRECTORY_SEPARATOR . 'libs' . DIRECTORY_SEPARATOR . 'Smarty.class.php';
$path = "." . DIRECTORY_SEPARATOR . "Utilities" . DIRECTORY_SEPARATOR;
require_once $path . "my_Autoloader.php";
require_once $path . "config.inc.php";

if(!\Control\C_LoginRegistration::isLogged() || \Control\C_LoginRegistration::isBanned()){
    header("Location: /index.php");
    exit();
}

$username = \Control\C_LoginRegistration::getUsername();
$role = \Control\C_LoginRegistration::getRole();
$user_details = \Entity\E_User::get_UserDetails($username);
$array_photo = \Entity\E_Photo::get_By_User($username, $username, $role);

$succes = filter_input(INPUT_GET, "success");
if (is_null($succes)) {
    \View\V_Profilo::showEditProfile($user_details, $array_photo);
} else {
    \View\V_Profilo::showEditProfile($user_details, $array_photo, true);
}

