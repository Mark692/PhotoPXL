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
 * This class menages the actions a user can do about the photos.
 *
 * @author Benedetta
 */
class C_Photo {

    private $role;

    /**
     * The constructor create an object photo containing the role of the user in session.
     */
    public function __construct() {
        $this->role = E_User::get_DB_Role($_SESSION["username"]);
    }

    /**
     * This method verify if the user s banned.
     * 
     * @return boolean true if the user is banned and return to the banned home.
     */
    private function isBanned() {
        if ($this->role == Roles::BANNED) {
            V_Home::bannedHome(); //per federico
            return true;
        }
        return false;
    }

    /**
     * This method checks the photo's privacy and if the user in session is the owner.
     * 
     * @param \Entity\E_Photo $photo
     * @return true if the photo is private and the current user is the owner.
     */
    private function checkPrivacyOwner($photo) {
        return $photo->get_Reserved() and ! E_Photo::is_TheUploader($_SESSION["username"], $photo->get_ID());
    }

    /**
     * This method is used to see a previously uploaded photo, after checking if the current user isn't
     * banned or he's a mod or an admin or the photo owner.
     * 
     * @param int $photoId the photo's id.
     * @return boolean true if the user can see the choosen photo.
     */
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
    }

    /**
     * This method allows to edit a photo after checking if the category to assign is a valid
     * cateogry and if the current user is banned or the owner of the photo.
     * 
     * @param int $photoId the photo's ID.
     * @param string $title the photo's title.
     * @param array $categories the photo's categories.
     * @param string $description the photo's description.
     * @return boolean true if the photo could be edit and all the changed were saved in the DB.
     */
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

    /**
     * This method is used to upload a photo after checking if the current user is banned and 
     * automatically assign an ID.
     * 
     * @param string $photoPath the photo's path.
     * @param string $title the photo's title.
     * @param array $categories the photo's categories
     * @param string $description the photo's description.
     * @param int $albumId the destion album's ID.
     * @return boolean true if the photo was correctly uploaded.
     */
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
            E_Photo::move_To($photoId, $albumId);
        }
        return true;
    }

    /**
     * This method allowes a user to comment a photo, after checking if the user is banned or if 
     * he has the permission to see the photo.
     * 
     * @param int $photoId the photo's ID.
     * @param string $text the user's comment.
     * @return boolean true if the comment was correctly added.
     */
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

    /**
     * This method allows a user to like or unlike a photo, after checkin if the user is banned
     * or he has the permission to see the photo.
     * 
     * @param int $photoId the photo's ID.
     * @return boolean true if the action went right.
     */
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
    }

    /**
     * This method is used to delete a photo, after checking if the user is banned or is a MOD, an
     * admin or the photo's owner.
     * 
     * @param int $photoId the photo's ID.
     * @return boolean true if the photo was correctly deleted.
     */
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
        return true;
    }

    /**
     * This method is used to set a photo's privacy, after checking if the user is banned or standard. 
     * In that case it appears a "Not Allowed" page.
     * 
     * @param int $photoId the photo's ID.
     * @return boolean true if the privacy was correctly set.
     */
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
        return true;
    }

    /**
     * This method is used to search a photo by its category, after checking if the user is banned.
     * 
     * @param array $category the photo's category.
     * @return boolean true if the research went right.
     */
    public function searchByCategory($category) {
        if ($this->isBanned($this->role)) {
            return false;
        }
        E_Photo::get_By_Categories($category, $_SESSION["username"], $this->role);
    }

    /**
     * This method is used to see all the comments of a photo, after checking if the user is banned.
     * 
     * @param int $photoId the photo's ID
     * @return boolean true if the action went right.
     */
    public function seeComments($photoId) {
        if ($this->isBanned($this->role)) {
            return false;
        }
        E_Photo::get_DB_CommentsList($photoId);
    }

    /**
     * This method is used to see al the likes of a photo, after checking if the user is banned.
     * 
     * @param int $photoId the photo's ID.
     * @return boolean true if the action went right.
     */
    public function seeLikes($photoId) {
        if ($this->isBanned($this->role)) {
            return false;
        }
        E_Photo::get_DB_LikeList($photoId);
    }

    /**
     * This method allows a user to change a photo's album, after checking if the user is banned
     * or is photo's owner and the album's creator.
     * 
     * @param int $photoId the photo's ID.
     * @param int $newAlbumId the destination album's ID.
     * @return boolean true if the album was correctly change.
     */
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
        return true;
    }
    
    /**
     * This method is used to show the homepage with the thumbnails of the most liked photos.
     * 
     * @return boolean true is the homepage was correctly view.
     */
    public function mostLiked(){
        if ($this->isBanned($this->role)) {
            return false;
        }
        V_Home::standardHome(E_Photo::get_MostLiked($_SESSION["username"], $this->role));
        return true;
    }
    
    /**
     * Returns most liked photos in the homepage, which must be encoded in a 
     * specific format (e.g. JSON) and then send to client
     * 
     * @param int $pageToView the next page to view
     * @return boolean true 
     */
    public function mostLikedAsync($pageToView){
         if ($this->isBanned($this->role)) {
            return false;
        }
        return E_Photo::get_MostLiked($_SESSION["username"], $this->role, $pageToView);
    }

}
