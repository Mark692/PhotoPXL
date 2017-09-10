<?php

session_start();

spl_autoload_register(function ($class_name) {
    include dirname(dirname(__FILE__)) . "/" . str_replace("\\", "/", $class_name) . '.php';
});

$path = ".." . DIRECTORY_SEPARATOR . "Utilities" . DIRECTORY_SEPARATOR;
require_once $path . "config.inc.php";

use Control\C_Album;

if(!\Control\C_LoginRegistration::isLogged()){
    json_encode(false);
}

$albumId=  filter_input(INPUT_POST, "albumId");
$pageToView=  filter_input(INPUT_POST, "pageToView");
echo json_encode(C_Album::seeAsync($albumId, $pageToView));