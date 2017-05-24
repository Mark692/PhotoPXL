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
use View\V_Home;
use View\V_Users;
use View\V_Profilo;
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
            V_Home::bannedHome();
            return false;
        }
        $photo_blob = new E_Photo_Blob();
        $photo_blob->on_Upload($photoPath); //$_FILES['userfile']['tmp_name']; in service
        E_User::upload_NewCover($_SESSION["username"], $photo_blob);
        V_Profilo::home(); //per Federico
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
            V_Home::bannedHome();
            return false;
        }
        if (!E_Photo::get_By_ID($photoId, $_SESSION["username"], $role)) {
            V_Home::error();
            return false;
        }
        if (!E_Photo::is_TheUploader($_SESSION["username"], $photoId)) {
            V_Home::notAllowed();
            return false;
        }
        E_User::set_ProfilePic($_SESSION["username"], $photoId);
        V_Profilo::home();
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
            V_Home::bannedHome();
            return false;
        }
        if (!E_Photo::is_TheUploader($_SESSION["username"], $photoId)) {
            V_Home::notAllowed();
            return false;
        }
        E_User::remove_CurrentProPic($_SESSION["username"]);
        V_Profilo::home();
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
            V_Home::bannedHome();
            return false;
        }
        try {
            E_User::change_Password($newPassword);
            V_Profile::banner(); //per Fede, appare un banner del tipo "password cambiata correttamente"
            return true;
        } catch (input_texts $e) {
            V_Home::error();
            return false;
        }
    }

    /**
     * This method is used to change the email.
     *
     * @param string $newEmail user's new email.
     * @return boolean true if the email was correctly changed.
     */
    public static function changeEmail($newEmail) {
        $role = E_User::get_DB_Role($_SESSION["username"]);
        if ($role == Roles::BANNED) {
            V_Home::bannedHome();
            return false;
        }
        try {
            E_User::change_Email($newEmail);
            V_Profilo::banner(); //per Fede, appare un banner del tipo "email cambiata correttamente"
            return true;
        } catch (input_texts $e) {
            V_Home::error();
            return false;
        }
    }

}
