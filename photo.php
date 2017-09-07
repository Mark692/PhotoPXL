<?php

session_start();

require_once '.'.DIRECTORY_SEPARATOR.'libs'.DIRECTORY_SEPARATOR.'Smarty.class.php';
$path = "." . DIRECTORY_SEPARATOR . "Utilities" . DIRECTORY_SEPARATOR;
require_once $path . "my_Autoloader.php";
require_once $path . "config.inc.php";

$username = \Control\C_LoginRegistration::getUsername();
$photo = \Entity\E_Photo::get_By_ID(filter_input(INPUT_GET, "id"),
        $username, \Control\C_LoginRegistration::getRole());
\View\V_Foto::showPhotoPage($photo, $username);