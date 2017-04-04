<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Control;

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
    public function uploadProPic($photoPath) {
        $role = \Entity\E_User::get_DB_Role($_SESSION["username"]);
        if ($role == \Utilities\Roles::BANNED) {
            \View\V_Home::bannedHome();
            return false;
        }
        $photo_blob = new E_Photo_Blob();
        $photo_blob->on_Upload($photoPath); //$_FILES['userfile']['tmp_name']; in service
        \Entity\E_User::upload_NewCover($_SESSION["username"], $photo_blob);
        \View\V_Users::showProfile(); //per Federico
        return true;
    }

    /**
     * This method is used to update the current profile picture with a new one
     * 
     * @param string $photoId the photo's path
     * @return boolean true if the photo was correctly updated.
     */
    public function updateProPic($photoId) {
        $role = \Entity\E_User::get_DB_Role($_SESSION["username"]);
        if ($role == \Utilities\Roles::BANNED) {
            \View\V_Home::bannedHome();
            return false;
        }
        if (!\Entity\E_Photo::get_By_ID($photoId, $_SESSION["username"], $role)) {
            \View\V_Home::error();
            return false;
        }
        if (!\Entity\E_Photo::is_TheUploader($_SESSION["username"], $photoId)) {
            \View\V_Home::notAllowed();
            return false;
        }
        \Entity\E_User::set_ProfilePic($_SESSION["username"], $photoId);
        \View\V_Users::showProfile();
        return true;
    }

    /**
     * This method is used to remove the current profil picture.
     * 
     * @param string $photoId the photo's path
     * @return boolean true if the photo was correctly removed.
     */
    public function removeProPic($photoId) {
        $role = \Entity\E_User::get_DB_Role($_SESSION["username"]);
        if ($role == \Utilities\Roles::BANNED) {
            \View\V_Home::bannedHome();
            return false;
        }
        if (!\Entity\E_Photo::is_TheUploader($_SESSION["username"], $photoId)) {
            \View\V_Home::notAllowed();
            return false;
        }
        \Entity\E_User::remove_CurrentProPic($_SESSION["username"]);
        \View\V_Users::showProfile();
        return true;
    }

    /**
     * This method is used to change the current password with a new one
     * 
     * @param user $user the user who's changing the password
     * @return boolean true if the password was correctly change.
     */
    public function changePassowrd($user) {
        $role = \Entity\E_User::get_DB_Role($_SESSION["username"]);
        if ($role == \Utilities\Roles::BANNED) {
            \View\V_Home::bannedHome();
            return false;
        }
        try {
            \Entity\E_User::change_Password($user);
            \View\V_Profile::banner(); //per Fede, appare un banner del tipo "password cambiata correttamente"
            return true;
        } catch (\Exceptions\input_texts $e) {
            \View\V_Home::error();
            return false;
        }
    }

    /**
     * This method is used to change the current email with a new one
     * 
     * @param user $user the user who's changing the email
     * @return boolean true if the email was correctly change.
     */
    public function changeEmail($user) {
        $role = \Entity\E_User::get_DB_Role($_SESSION["username"]);
        if ($role == \Utilities\Roles::BANNED) {
            \View\V_Home::bannedHome();
            return false;
        }
        try {
            \Entity\E_User::change_Email($user);
            \View\V_Profile::banner(); //per Fede, appare un banner del tipo "email cambiata correttamente"
            return true;
        } catch (\Exceptions\input_texts $e) {
            \View\V_Home::error();
            return false;
        }
    }

}
