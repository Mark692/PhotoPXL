<?php

session_start();

spl_autoload_register(function ($class_name) {
    include dirname(dirname(__FILE__)) . "/" . str_replace("\\", "/", $class_name) . '.php';
});

$path = ".." . DIRECTORY_SEPARATOR . "Utilities" . DIRECTORY_SEPARATOR;
require_once $path . "config.inc.php";

use Control\C_Profile;

if(!\Control\C_LoginRegistration::isLogged()){
    header("Location: /index.php");
    exit();
}

$action = filter_input(INPUT_POST, "action");
$success = true;

switch ($action) {
    case "edit":
        $newUsername = filter_input(INPUT_POST, "username");
        $newEmail = filter_input(INPUT_POST, "email");
        $newPassword = filter_input(INPUT_POST, "password");
        if (!is_null($newUsername) && !empty($newUsername)) {
            $success = C_Profile::changeUserName($newUsername);
        }
        if ($success && !is_null($newPassword) && !empty($newPassword)) {
            $success = C_Profile::changePassword($newPassword);
        }
        if ($success && !is_null($newEmail) && !empty($newEmail)) {
            $success = C_Profile::changeEmail($newEmail);
        }
        break;
    case "picture":
        $photoId = filter_input(INPUT_POST, "photoId");
        C_Profile::removeProPic($photoId);
        C_Profile::updateProPic($photoId);
        $photoPath = filter_input(INPUT_POST, "photoPath");
        C_Profile::uploadProPic($photoPath);
        break;
}

if ($success) {
    header("Location: /edit_profile.php?success=1");
} else {
    header("Location: /error.php");
}