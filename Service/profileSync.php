<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Control\C_Profile;

$action = filter_input(INPUT_POST, "action");
;
switch ($action) {
    case "changeEmail": $newEmail = filter_input(INPUT_POST, "newEmail");
        C_Profile::changeEmail($newEmail);
        break;
    case "changePassowrd": $newPassword = filter_input(INPUT_POST, "newPassword");
        C_Profile::changePassword($newPassword);
        break;
    case "removeProPic": $photoId = filter_input(INPUT_POST, "photoId");
        C_Profile::removeProPic($photoId);
        break;
    case "updateProPic": $photoId = filter_input(INPUT_POST, "photoId");
        C_Profile::updateProPic($photoId);
        break;
    case "uploadProPic": $photoPath = filter_input(INPUT_POST, "photoPath");
        C_Profile::uploadProPic($photoPath);
        break;
    default;
}