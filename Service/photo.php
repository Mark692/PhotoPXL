<?php

session_start();

spl_autoload_register(function ($class_name) {
    include dirname(dirname(__FILE__)) . "/" . str_replace("\\", "/", $class_name) . '.php';
});

$path = ".." . DIRECTORY_SEPARATOR . "Utilities" . DIRECTORY_SEPARATOR;
require_once $path . "config.inc.php";

use Control\C_Photo;

if(!\Control\C_LoginRegistration::isLogged()){
    json_encode(false);
}

$photo = new C_Photo();
$action = filter_input(INPUT_POST, "action");
switch ($action) {
    case "comment": $photoId = filter_input(INPUT_POST, "photoId");
        $text = filter_input(INPUT_POST, "text");
        $returns = $photo->comment($photoId, $text);
        break;
    case "editComment":$photoId = filter_input(INPUT_POST, "photoId");
        $text = filter_input(INPUT_POST, "text");
        $comment = filter_input(INPUT_POST, "commentId");
        $returns = $photo->editComment($photoId, $text, intval($comment));
        break;
    case "deleteComment": $comment = filter_input(INPUT_POST, "commentId");
        $returns = $photo->deleteComment($comment);
        break;
    case "likeUnlike": $photoId = filter_input(INPUT_POST, "photoId");
        $returns = $photo->likeUnlike($photoId);
        break;
    case "mostLikedAsync": $pageToView = filter_input(INPUT_POST, "pageToView");
        $returns = $photo->mostLikedAsync($pageToView);
        break;
    case "privacy": $photoId = filter_input(INPUT_POST, "photoId");
        $returns = $photo->privacy($photoId);
    default: $returns = false;
}

echo json_encode($returns);