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

    private $role;

    public function __construct() {
        $this->role = E_User::get_DB_Role($_SESSION["username"]);
    }

    private function isBanned() {
        if ($this->role == Roles::BANNED) {
            V_Home::bannedHome(); //per federico
            return true;
        }
        return false;
    }
    
    /**
     * 
     * @param \Entity\E_Photo $photo 
     */
    private function checkPrivacyOwner($photo){
        return $photo->get_Reserved() and ! E_Photo::is_TheUploader($_SESSION["username"], $photo->get_ID());
    }

    public function see($photoId) {
        if ($this->isBanned($this->role)) {
            return false;
        }
        $photo = E_Photo::get_By_ID($photoId, $_SESSION["username"], $this->role);
        /* @var $photo \Entity\E_Photo */
        if ($this->role != Roles::MOD and $this->role != Roles::ADMIN and $this->checkPrivacyOwner($photo)) {
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
        if ($this->isBanned($this->role)) {
            return false;
        }
        if (!E_Photo::is_TheUploader($_SESSION["username"], $photoId)) {
            V_Home::error();
            return false;
        }
        $photo = E_Photo::get_By_ID($photoId, $_SESSION['username'], $this->role);
        /* @var $photo \Entity\E_Photo */
        $photo->set_Title($title);
        $photo->set_Categories($categories);
        $photo->set_Description($description);
        \Entity\E_Photo::update($photo);

        return true;
    }

    public function upload($photoPath, $title, $categories, $description, $albumId = null) {
        if ($this->isBanned($this->role)) {
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
        if ($this->isBanned($this->role)) {
            return false;
        }
        $photo = E_Photo::get_By_ID($photoId, $_SESSION["username"], $this->role);
        /* @var $photo \Entity\E_Photo */
        if ($this->checkPrivacyOwner($photo)) {
            V_Home::notAllowed();
            return false;
        }
        E_Comment::insert(new E_Comment($text, $_SESSION["username"], $photoId));
    }

    public function likeUnlike($photoId) {
        if ($this->isBanned($this->role)) {
            return false;
        }
        $photo = E_Photo::get_By_ID($photoId, $_SESSION["username"], $this->role);
        /* @var $photo \Entity\E_Photo */
        if ($this->checkPrivacyOwner($photo)) {
            V_Home::notAllowed();
            return false;
        }
        if (!E_User::add_Like_to($photoId, $_SESSION["username"])) {
            E_User::remove_Like($_SESSION["username"], $photoId);
        }
        return true;
    }

    public function delete($photoId) {
        if ($this->isBanned($this->role)) {
            return false;
        }
        $photo = E_Photo::get_By_ID($photoId, $_SESSION["username"], $this->role);
        /* @var $photo \Entity\E_Photo */
        if ($this->role != Roles::MOD and $this->role != Roles::ADMIN
                and $this->checkPrivacyOwner($photo)) {
            V_Home::notAllowed();
        }
        E_Photo::delete($photoId);
    }

    public function privacy($photoId) {
        if ($this->isBanned($this->role)) {
            return false;
        }
        if ($this->role == Roles::STANDARD or ( !E_Photo::is_TheUploader($_SESSION["username"], $photoId))) {
            V_Home::notAllowed();
            return false;
        }
        $photo = E_Photo::get_By_ID($photoId, $_SESSION["username"], $this->role);
        /* @var $photo \Entity\E_Photo */
        $photo->set_Reserved(!$photo->get_Reserved());
        E_Photo::update($photoId);
    }

    public function searchByCategory($category) {
        if ($this->isBanned($this->role)) {
            return false;
        }
        E_Photo::get_By_Categories($category, $_SESSION["username"], $this->role);
    }

    public function seeComments($photoId) {
        if ($this->isBanned($this->role)) {
            return false;
        }
        E_Photo::get_DB_CommentsList($photoId);
    }

    public function seeLikes($photoId) {
        if ($this->isBanned($this->role)) {
            return false;
        }
        E_Photo::get_DB_LikeList($photoId);
    }

    public function changeAlbum($photoId, $newAlbumId = null) {
        if ($this->isBanned($this->role)) {
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
        E_Photo::move_To($photoId, $newAlbumId);
    }

}
