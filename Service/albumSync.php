<?php

session_start();

spl_autoload_register(function ($class_name) {
    include dirname(dirname(__FILE__)) . "/" . str_replace("\\", "/", $class_name) . '.php';
});

$path = ".." . DIRECTORY_SEPARATOR . "Utilities" . DIRECTORY_SEPARATOR;
require_once $path . "config.inc.php";

use Control\C_Album;

if(!\Control\C_LoginRegistration::isLogged()){
    header("Location: /index.php");
    exit();
}

$action = filter_input(INPUT_POST, "action");
switch($action){
    case "create": $title = filter_input(INPUT_POST, "title");
        $categories = filter_input(INPUT_POST, "categories", FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $description = filter_input(INPUT_POST, "description");
        $albumId = C_Album::create($title, $categories, $description);
        header("Location: /album.php?id=$albumId");
        break;
    case "delete": $albumId = filter_input(INPUT_POST, "albumId");
        $withPhotos = (boolean) filter_input(INPUT_POST, "withPhotos");
        C_Album::delete($albumId, $withPhotos);
        header("Location: /profile.php");
        break;
    case "edit": $albumId = filter_input(INPUT_POST, "albumId");
        $title = filter_input(INPUT_POST, "title");
        $categories = filter_input(INPUT_POST, "categories", FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $description = filter_input(INPUT_POST, "description");
        C_Album::edit($albumId, $title, $categories, $description);
        break;
    case "see": $albumId = filter_input(INPUT_POST, "albumId");
        C_Album::see($albumId);
        break;
    default;
}