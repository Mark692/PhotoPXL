<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Control\C_LoginRegistration;

$action = filter_input(INPUT_POST, "action");
switch ($action) {
    case "login": $username = filter_input(INPUT_POST, "username");
        $nonce = filter_input(INPUT_POST, "nonce");
        $hash = filter_input(INPUT_POST, "hash");
        $keepLogged = (boolean) filter_input(INPUT_POST, "keepLogged");
        $returns = C_LoginRegistration::login($username, $nonce, $hash, $keepLogged);
        break;
    case "registration": $username = filter_input(INPUT_POST, "username");
        $email = filter_input(INPUT_POST, "email");
        $password = filter_input(INPUT_POST, "password");
        $keepLogged = (boolean) filter_input(INPUT_POST, "keepLogged");
        $returns = C_LoginRegistration::register($username, $email, $password, $keepLogged);
        break;
    case "checkusername": $username = filter_input(INPUT_POST, "username");
        $returns = C_LoginRegistration::isAvailable($username);
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

echo json_encode($returns);
