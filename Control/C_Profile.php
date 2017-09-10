<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Control;

use Entity\E_User;
use Entity\E_Photo;
use Utilities\Roles;
use Exceptions\input_texts;

/**
 * This class menages the profile picture.
 *
 * @author Benedetta
 */
class C_Profile {

    /**
     * This method is used to upload a new profile picture
     *
     * @param string $photoPath the photo's path
     * @return boolean true if the photo was correctly uploaded
     */
    public static function uploadProPic($photoPath) {
        $role = E_User::get_DB_Role($_SESSION["username"]);
        if ($role == Roles::BANNED) {
            header("Location: /index.php");
            exit();
        }
        $photo_blob = new E_Photo_Blob();
        $photo_blob->on_Upload($photoPath); //$_FILES['userfile']['tmp_name']; in service
        E_User::upload_NewCover($_SESSION["username"], $photo_blob);
        return true;
    }

    /**
     * This method is used to update the current profile picture with a new one
     *
     * @param string $photoId the photo's path
     * @return boolean true if the photo was correctly updated.
     */
    public static function updateProPic($photoId) {
        $role = E_User::get_DB_Role($_SESSION["username"]);
        if ($role == Roles::BANNED) {
            header("Location: /index.php");
            exit();
        }
        if (!E_Photo::get_By_ID($photoId, $_SESSION["username"], $role)) {
            return false;
        }
        if (!E_Photo::is_TheUploader($_SESSION["username"], $photoId)) {
            return false;
        }
        E_User::set_ProfilePic($_SESSION["username"], $photoId);
        return true;
    }

    /**
     * This method is used to remove the current profil picture.
     *
     * @param string $photoId the photo's path
     * @return boolean true if the photo was correctly removed.
     */
    public static function removeProPic($photoId) {
        $role = E_User::get_DB_Role($_SESSION["username"]);
        if ($role == Roles::BANNED) {
            header("Location: /index.php");
            exit();
        }
        if (!E_Photo::is_TheUploader($_SESSION["username"], $photoId)) {
            return false;
        }
        E_User::remove_CurrentProPic($_SESSION["username"]);
        return true;
    }

    /**
     * This method is used to change the password
     *
     * @param string $newPassword user's new password
     * @return boolean true is the password was correctly changed.
     */
    public static function changePassword($newPassword) {
        $role = E_User::get_DB_Role($_SESSION["username"]);
        if ($role == Roles::BANNED) {
            header("Location: /index.php");
            exit();
        }
        try {
            $user = E_User::get_UserDetails($_SESSION["username"]);
            /* @var $user \Entity\E_User */
            $user->set_Password($newPassword);
            E_User::change_Password($user);
            return true;
        } catch (input_texts $e) {
            return false;
        }
    }

    /**
     * This method is used to change the current user's name
     * 
     * @param string $newUsername the new username
     * @return boolean whether it success or not.
     */
    public static function changeUserName($newUsername) {
        $role = E_User::get_DB_Role($_SESSION["username"]);
        if ($role == Roles::BANNED) {
            header("Location: /index.php");
            exit();
        }
        try {
            $user = E_User::get_UserDetails($_SESSION["username"]);
            /* @var $user \Entity\E_User */
            $user->set_Username($newUsername);
            E_User::change_Username($user, $_SESSION["username"]);
            $_SESSION["username"] = $newUsername;
            return true;
        } catch (input_texts $e) {
            return false;
        }
    }

    /**
     * This method is used to change current user's email.
     * 
     * @param string $newEmail the new email to submit.
     * @return boolean whether it success or not.
     */ 
    public static function changeEmail($newEmail) {
        $role = E_User::get_DB_Role($_SESSION["username"]);
        if ($role == Roles::BANNED) {
            header("Location: /index.php");
            exit();
        }
        try {
            $user = E_User::get_UserDetails($_SESSION["username"]);
            /* @var $user \Entity\E_User */
            $user->set_Email($newEmail);
            E_User::change_Email($user);
            return true;
        } catch (input_texts $e) {
            return false;
        }
    }
}
