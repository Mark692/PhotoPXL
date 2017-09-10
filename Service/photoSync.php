<?php

session_start();

spl_autoload_register(function ($class_name) {
    include dirname(dirname(__FILE__)) . "/" . str_replace("\\", "/", $class_name) . '.php';
});

$path = ".." . DIRECTORY_SEPARATOR . "Utilities" . DIRECTORY_SEPARATOR;
require_once $path . "config.inc.php";

use Control\C_Photo;

if(!\Control\C_LoginRegistration::isLogged()){
    header("Location: /index.php");
    exit();
}

$photo = new C_Photo();
$action = filter_input(INPUT_POST, "action");
switch ($action) {
    case "edit": $photoId = filter_input(INPUT_POST, "id");
        $title = filter_input(INPUT_POST, "title");
        $categories = filter_input(INPUT_POST, "categories", FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $description = filter_input(INPUT_POST, "description");
        $reserved = filter_input(INPUT_POST, "is_reserved");
        $isReserved = (is_null($reserved) || $reserved == 'FALSE') ? false : true;
        $photo->edit($photoId, $title, $categories, $description, $isReserved);
        header("Location: /photo.php?id=$photoId");
        exit();
    case "upload": $photoPath = $_FILES['photo']['tmp_name'];
        $title = filter_input(INPUT_POST, "title");
        $categories = filter_input(INPUT_POST, "categories", FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $description = filter_input(INPUT_POST, "description");
        $albumId = filter_input(INPUT_POST, "albumId");
        $reserved = filter_input(INPUT_POST, "is_reserved");
        $isReserved = (is_null($reserved) || $reserved == 'FALSE') ? false : true;
        $id = $photo->upload($photoPath, $title, $categories, $description, $isReserved, $albumId);
        header("Location: /photo.php?id=$id");
        exit();
    case "delete": $photoId = filter_input(INPUT_POST, "id");
        $photo->delete(intval($photoId));
        header("Location: /profile.php");
        exit();
    case "changeAlbum": $photoId = filter_input(INPUT_POST, "photoId");
        $newAlbumId = filter_input(INPUT_POST, "newAlbumId");
        $photo->changeAlbum($photoId, $newAlbumId);
        break;
    default: break;
}