<?php

spl_autoload_register(function ($class_name) {
    include dirname(dirname(__FILE__)) . "/" . str_replace("\\", "/", $class_name) . '.php';
});

$path = ".." . DIRECTORY_SEPARATOR . "Utilities" . DIRECTORY_SEPARATOR;
require_once $path . "config.inc.php";

use Control\C_LoginRegistration;

$action = filter_input(INPUT_POST, "action");
switch ($action) {
    case "login": $username = filter_input(INPUT_POST, "username");
        $password = filter_input(INPUT_POST, "password");
        $returns = C_LoginRegistration::login($username, $password, true);
        if (!$returns) {
            header("Location: /index.php?failed=1");
        } else {
            header("Location: /index.php");
        }
        return;
    case "registration": $username = filter_input(INPUT_POST, "username");
        $email = filter_input(INPUT_POST, "email");
        $password = filter_input(INPUT_POST, "password");
        $returns = C_LoginRegistration::register($username, $email, $password, true);
        if (!$returns) {
            header("Location: /registration.php?failed=1");
        } else {
            header("Location: /index.php");
        }
        return;
    case "checkusername": $username = filter_input(INPUT_POST, "username");
        echo json_encode(C_LoginRegistration::isAvailable($username));
        break;
    case "requirenonce": $returns = C_LoginRegistration::getNonce();
        break;
    case "gettoken": $username = filter_input(INPUT_POST, "username");
        $returns = C_LoginRegistration::getToken($username);
        break;
    case "resetpassword": $username = filter_input(INPUT_POST, "username");
        $userToken = filter_input(INPUT_POST, "userToken");
        $keepLogged = (boolean) filter_input(INPUT_POST, "keepLogged");
        $newPassword = filter_input(INPUT_POST, "newPassword");
        $returns = C_LoginRegistration::resetPassword($username, $userToken, $keepLogged, $newPassword);
        break;
    case "logout": $returns = C_LoginRegistration::logout();
        break;
    default : $returns = false;
}
