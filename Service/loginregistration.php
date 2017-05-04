<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Control\C_LoginRegistration;

$username = filter_input(INPUT_POST, "username");
$action = filter_input(INPUT_POST, "action");
switch ($action) {
    case "login": $nonce = filter_input(INPUT_POST, "nonce");
        $hash = filter_input(INPUT_POST, "hash");
        $keepLogged = (boolean) filter_input(INPUT_POST, "keepLogged");
        $returns = C_LoginRegistration::login($username, $nonce, $hash, $keepLogged);
        break;
    case "registration": $email = filter_input(INPUT_POST, "email");
        $password = filter_input(INPUT_POST, "password");
        $keepLogged = (boolean) filter_input(INPUT_POST, "keepLogged");
        $returns = C_LoginRegistration::register($username, $email, $password, $keepLogged);
        break;
    case "checkusername": $returns = C_LoginRegistration::isAvailable($username);
        break;
    case "requirenonce": $returns = C_LoginRegistration::getNonce();
        break;
    case "gettoken": $returns = C_LoginRegistration::getToken($username);
        break;
    case "resetpassword": $userToken = filter_input(INPUT_POST, "userToken");
        $keepLogged = (boolean) filter_input(INPUT_POST, "keepLogged");
        $newPassword = filter_input(INPUT_POST, "newPassword");
        $returns = C_LoginRegistration::resetPassword($username, $userToken, $keepLogged, $newPassword);
        break;
    case "logout": $returns = C_LoginRegistration::logout();
        break;
    default : $returns = false;
}

echo json_encode($returns);
