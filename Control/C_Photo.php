<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Control;

use Entity\E_User;
use Entity\E_Photo;
use Entity\E_Comment;
use Entity\E_Album;
use Utilities\Roles;
use View\V_Home;
use View\V_Foto;

/**
 * Description of P_Photo
 *
 * @author Benedetta
 */
class C_Photo {

    public function see($photoId) {
        $role = E_User::get_DB_Role($_SESSION["username"]);
        if ($role == Roles::BANNED) {
            V_Home::bannedHome(); //per federico
            return false;
        }
        $photo = E_Photo::get_By_ID($photoId, $_SESSION["username"], $role);
        /* @var $photo \Entity\E_Photo */
        if ($role != Roles::MOD and $role != Roles::ADMIN and 
                ( $photo->get_Reserved() and 
                ! E_Photo::is_TheUploader($_SESSION["username"], $photoId))) {
            V_Home::notAllowed();
            //per federico: richiama la home e scrive "non consentito" al posto delle anteprime foto
            return false;
        }
        V_Foto::showPhotoPage(E_User::get_UserDetails($_SESSION["username"]), $photo);
        //per Federico
        return true;
    }

    public function edit($photoId, $title, $categories, $description) {
        foreach ($categories as $category) {
            if ($category != PAESAGGI and $category != RITRATTI and $category != FAUNA
                    and $category != BIANCONERO and $category != ASTRONOMIA and
                    $category != STREET and $category != NATURAMORTA and $category != SPORT) {
                V_Home::error(); //per federico: pagina con scritto "errore"
                return false;
            }
        }
        $role = E_User::get_DB_Role($_SESSION["username"]);
        if ($role == Roles::BANNED) {
            V_Home::bannedHome();
            return false;
        }
        if (!E_Photo::is_TheUploader($_SESSION["username"], $photoId)) {
            V_Home::error();
            return false;
        }
        $photo = E_Photo::get_By_ID($photoId, $_SESSION['username'], $role);
        /* @var $photo \Entity\E_Photo */
        $photo->set_Title($title);
        $photo->set_Categories($categories);
        $photo->set_Description($description);
        \Entity\E_Photo::update($photo);

        return true;
    }

    public function upload($photoPath, $title, $categories, $description, $albumId = null) {
        if (E_User::get_DB_Role($_SESSION["username"]) == Roles::BANNED) {
            V_Home::bannedHome();
            return false;
        }
        $photo_blob = new E_Photo_Blob();
        $photo_blob->on_Upload($photoPath); //$_FILES['userfile']['tmp_name']; in service
        $photo = new E_Photo($title);
        $photo->set_Categories($categories);
        $photo->set_Description($description);
        $photoId = E_Photo::insert($photo, $photo_blob, $_SESSION["username"]);
        if (!is_null($albumId)) {
            E_Photo::move_To($albumId, $photoId);
        }
        return true;
    }

    public function comment($photoId, $text) {
        $role = E_User::get_DB_Role($_SESSION["username"]);
        if ($role == Roles::BANNED) {
            V_Home::bannedHome();
            return false;
        }
        $photo = E_Photo::get_By_ID($photoId, $_SESSION["username"], $role);
        /* @var $photo \Entity\E_Photo */
        if ($photo->get_Reserved() and ! E_Photo::is_TheUploader($_SESSION["username"], $photoId)) {
            V_Home::notAllowed();
            return false;
        }
        E_Comment::insert(new E_Comment($text, $_SESSION["username"], $photoId));
    }

    public function likeUnlike($photoId) {
        $role = E_User::get_DB_Role($_SESSION["username"]);
        if ($role == Roles::BANNED) {
            V_Home::bannedHome();
            return false;
        }
        $photo = E_Photo::get_By_ID($photoId, $_SESSION["username"], $role);
        /* @var $photo \Entity\E_Photo */
        if ($photo->get_Reserved() and ! E_Photo::is_TheUploader($_SESSION["username"], $photoId)) {
            V_Home::notAllowed();
            return false;
        }
        if (!E_User::add_Like_to($photoId, $_SESSION["username"])) {
            E_User::remove_Like($_SESSION["username"], $photoId);
        }
        return true;
    }

    public function delete($photoId) {
        $role = E_User::get_DB_Role($_SESSION["username"]);
        if ($role == Roles::BANNED) {
            V_Home::bannedHome();
            return false;
        }
        $photo = E_Photo::get_By_ID($photoId, $_SESSION["username"], $role);
        /* @var $photo \Entity\E_Photo */
        if ($role != Roles::MOD and $role != Roles::ADMIN
                and ( $photo->get_Reserved() and 
                ! E_Photo::is_TheUploader($_SESSION["username"], $photoId))) {
            V_Home::notAllowed();
        }
        E_Photo::delete($photoId);
    }

    public function privacy($photoId) {
        $role = E_User::get_DB_Role($_SESSION["username"]);
        if ($role == Roles::BANNED) {
            V_Home::bannedHome();
            return false;
        }
        if ($role == Roles::STANDARD or ( !E_Photo::is_TheUploader($_SESSION["username"], $photoId))) {
            V_Home::notAllowed();
            return false;
        }
        $photo = E_Photo::get_By_ID($photoId, $_SESSION["username"], $role);
        /* @var $photo \Entity\E_Photo */
        $photo->set_Reserved(!$photo->get_Reserved());
        E_Photo::update($photoId);
    }

    public function searchByCategory($category) {
        $role = E_User::get_DB_Role($_SESSION["username"]);
        if ($role == Roles::BANNED) {
            V_Home::bannedHome();
            return false;
        }
        E_Photo::get_By_Categories($category, $_SESSION["username"], $role);
    }

    public function seeComments($photoId) {
        $role = E_User::get_DB_Role($_SESSION["username"]);
        if ($role == Roles::BANNED) {
            V_Home::bannedHome();
            return false;
        }
        E_Photo::get_DB_CommentsList($photoId);
    }

    public function seeLikes($photoId) {
        $role = E_User::get_DB_Role($_SESSION["username"]);
        if ($role == Roles::BANNED) {
            V_Home::bannedHome();
            return false;
        }
        E_Photo::get_DB_LikeList($photoId);
    }

    public function changeAlbum($photoId, $newAlbumId = null) {
        $role = E_User::get_DB_Role($_SESSION["username"]);
        if ($role == Roles::BANNED) {
            V_Home::bannedHome();
            return false;
        }
        if (!E_Photo::is_TheUploader($_SESSION["username"], $photoId)) {
            V_Home::notAllowed();
            return false;
        }
        if (!E_Album::is_TheCreator($_SESSION["username"], $newAlbumId)) {
            V_Home::notAllowed();
            return false;
        }
        if (!is_null($newAlbumId)) {
            E_Photo::move_To($newAlbumId, $photoId);
        } 
            else;
    }

}
