<?php
session_start();

spl_autoload_register(function ($class_name) {
    include dirname(dirname(__FILE__)) . "/" . str_replace("\\", "/", $class_name) . '.php';
});

$path = ".." . DIRECTORY_SEPARATOR . "Utilities" . DIRECTORY_SEPARATOR;
require_once $path . "config.inc.php";

use Control\C_Photo;

$photo = new C_Photo();
$action = filter_input(INPUT_POST, "action");
switch ($action) {
    case "see": $photoId = filter_input(INPUT_POST, "photoId");
        $photo->see($photoId);
        break;
    case "edit": $photoId = filter_input(INPUT_POST, "photoId");
        $title = filter_input(INPUT_POST, "title");
        $categories = filter_input(INPUT_POST, "categories");
        $description = filter_input(INPUT_POST, "description");
        $photo->edit($photoId, $title, $categories, $description);
        break;
    case "upload": $photoPath = $_FILES['photo']['tmp_name'];
        $title = filter_input(INPUT_POST, "title");
        $categories = filter_input(INPUT_POST, "categories");
        $description = filter_input(INPUT_POST, "description");
        $albumId = filter_input(INPUT_POST, "albumId");
        $reserved = filter_input(INPUT_POST, "is_reserved");
        $isReserved = (is_null($reserved) || $reserved == 'FALSE') ? false : true;
        $id = $photo->upload($photoPath, $title, $categories, $description, $isReserved, $albumId);
        header("Location: photo.php/id?$id");
        exit();
    case "delete": $photoId = filter_input(INPUT_POST, "photoId");
        $albumId = filter_input(INPUT_POST, "albumId");
        $photo->delete($photoId);
        break;
    case "searchByCategory": $category = filter_input(INPUT_POST, "category");
        $photo->searchByCategory($category);
        break;
    case "changeAlbum": $photoId = filter_input(INPUT_POST, "photoId");
        $newAlbumId = filter_input(INPUT_POST, "newAlbumId");
        $photo->changeAlbum($photoId, $newAlbumId);
        break;
    case "mostLiked": $photo->mostLiked();
        break;
    default: break;
}