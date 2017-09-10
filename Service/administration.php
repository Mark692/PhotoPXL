<?php

session_start();

spl_autoload_register(function ($class_name) {
    include dirname(dirname(__FILE__)) . "/" . str_replace("\\", "/", $class_name) . '.php';
});

$path = ".." . DIRECTORY_SEPARATOR . "Utilities" . DIRECTORY_SEPARATOR;
require_once $path . "config.inc.php";

use Control\C_Administration;

if(!\Control\C_LoginRegistration::isLogged()){
    json_encode(false);
}

$username = filter_input(INPUT_POST, "username");
$action = filter_input(INPUT_POST, "action");
switch ($action) {
    case "changeRole": $role = filter_input(INPUT_POST, "role");
        $returns = C_Administration::changeRole($username, intval($role));
        break;
    case "ban": $returns = C_Administration::ban($username);
        break;
    default : $return = false;
}

echo json_encode($returns);
