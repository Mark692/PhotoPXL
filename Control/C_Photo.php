<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Control;

use Entity\E_User;
use Entity\E_Photo;
use Entity\E_Photo_Blob;
use Entity\E_Comment;
use Entity\E_Album;
use Utilities\Roles;
use View\V_Home;
use View\V_Foto;
use View\V_Album;

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
            return true;
        }
        return false;
    }

    /**
     * This method checks the photo's privacy and if the user in session is the owner.
     * 
     * @param \Entity\E_Photo $photo
     * @return boolean true if the photo is private and the current user is the owner.
     */
    private function checkPrivacyOwner($photo) {
        return $photo->get_Reserved() && !E_Photo::is_TheUploader($_SESSION["username"], $photo->get_ID());
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
            V_Home::bannedHome();
            return false;
        }
        $photo = E_Photo::get_By_ID($photoId, $_SESSION["username"], $this->role);
        if(!$photo) {
            header("Location: /error.php");
            exit();
        }
        /* @var $photo \Entity\E_Photo */
        if ($this->role != Roles::MOD && $this->role != Roles::ADMIN && $this->checkPrivacyOwner($photo['photo'])) {
            V_Home::notAllowed(E_Photo::get_MostLiked($_SESSION["username"], $this->role), $_SESSION["username"]);
            return false;
        }
        V_Foto::showPhotoPage($photo, $_SESSION["username"]);
    }

    /**
     * This method allows to edit a photo after checking if the category to assign is a valid
     * cateogry and if the current user is banned or the owner of the photo.
     * 
     * @param int $photoId the photo's ID.
     * @param string $title the photo's title.
     * @param array $categories the photo's categories.
     * @param string $description the photo's description.
     * @param boolean $reserved whether the photo is reserved or not
     * @return boolean true if the photo could be edit and all the changed were saved in the DB.
     */
    public function edit($photoId, $title, $categories, $description, $reserved) {
        if ($this->isBanned($this->role)) {
            header("Location: index.php");
            exit();
        }
        if (!E_Photo::is_TheUploader($_SESSION["username"], $photoId)) {
            return false;
        }
        $photo = E_Photo::get_By_ID($photoId, $_SESSION['username'], $this->role)['photo'];
        /* @var $photo \Entity\E_Photo */
        if (!empty($title)) {
            $photo->set_Title($title);
        }
        if (!is_null($categories)) {
            foreach ($categories as $category) {
                if ($category != PAESAGGI and $category != RITRATTI and $category != FAUNA
                        and $category != BIANCONERO and $category != ASTRONOMIA and
                        $category != STREET and $category != NATURAMORTA and $category != SPORT) {
                    return false;
                }
            }
            $photo->set_Categories($categories);
        }
        if (!empty($description)) {
            $photo->set_Description($description);
        }
        if (!is_null($reserved)) {
            $photo->set_Reserved($reserved);
        }
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
     * @param boolean $reserved whether the photo is reserved or not
     * @param int $albumId the destion album's ID.
     * @return int id of uploaded photo.
     */
    public function upload($photoPath, $title, $categories, $description, $reserved, $albumId = null) {
        if ($this->isBanned($this->role)) {
            header("Location: index.php", true, 301);
            exit();
        }
        if (is_null($categories)) {
            $categories = [];
        }
        $photo_blob = new E_Photo_Blob();
        $photo_blob->on_Upload($photoPath);
        $photo = new E_Photo($title);
        $photo->set_Categories($categories);
        $photo->set_Description($description);
        $photo->set_Reserved($reserved);
        E_Photo::insert($photo, $photo_blob, $_SESSION["username"]);
        if (!is_null($albumId)) {
            E_Photo::move_To($photo->get_ID(), $albumId);
        }
        return $photo->get_ID();
    }

    /**
     * This method allowes a user to comment a photo, after checking if the user is banned or if 
     * he has the permission to see the photo.
     * 
     * @param int $photoId the photo's ID.
     * @param string $text the user's comment.
     * @return boolean|int false if not succeded, comment id otherwise
     */
    public function comment($photoId, $text) {
        if ($this->isBanned($this->role)) {
            return false;
        }
        $photo = E_Photo::get_By_ID($photoId, $_SESSION["username"], $this->role)["photo"];
        /* @var $photo \Entity\E_Photo */
        if ($this->checkPrivacyOwner($photo)) {
            return false;
        }
        return E_Comment::insert(new E_Comment($text, $_SESSION["username"], $photoId));
    }

    /**
     * This method is used to edit a comment.
     * 
     * @param int $photoId the id of the photo
     * @param string $text the text of the comment
     * @param int $commentId the id of the comment
     * @return boolean whether it success or not.
     */
    public function editComment($photoId, $text, $commentId) {
        if ($this->isBanned($this->role)) {
            return false;
        }

        try {
            $comment = new E_Comment($text, $_SESSION["username"], $photoId);
            $comment->set_ID($commentId);
            E_Comment::update($comment);
            return true;
        } catch (\Exceptions\queries $e) {
            return false;
        }
    }

    /**
     * This method is used to delete a comment.
     * 
     * @param int $commentId the id of the comment.
     * @return boolean whether it success or not.
     */
    public function deleteComment($commentId) {
        if ($this->isBanned($this->role)) {
            return false;
        }

        try {
            E_Comment::remove($commentId);
            return true;
        } catch (\Exceptions\queries $e) {
            return false;
        }
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
        $photo = E_Photo::get_By_ID($photoId, $_SESSION["username"], $this->role)['photo'];
        /* @var $photo \Entity\E_Photo */
        if ($this->checkPrivacyOwner($photo)) {
            return false;
        }
        if (!E_User::add_Like_to($photoId, $_SESSION["username"])) {
            E_User::remove_Like($_SESSION["username"], $photoId);
            return -1;
        }
        return 1;
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
            header("Location: /index.php");
            exit();
        }
        $photo = E_Photo::get_By_ID($photoId, $_SESSION["username"], $this->role)['photo'];
        /* @var $photo \Entity\E_Photo */
        if ($this->role != Roles::MOD && $this->role != Roles::ADMIN && $this->checkPrivacyOwner($photo)) {
            return false;
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
            header("Location: index.php");
            exit();
        }
        $photos = E_Photo::get_By_Categories($category, $_SESSION["username"], $this->role);
        V_Home::showPhotoCollection($photos, $_SESSION["username"]);
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
        return E_Photo::get_DB_CommentsList($photoId);
    }

    /**
     * This method is used to see all the likes of a photo, after checking if the user is banned.
     * 
     * @param int $photoId the photo's ID.
     * @return boolean true if the action went right.
     */
    public function seeLikes($photoId) {
        if ($this->isBanned($this->role)) {
            return false;
        }
        return E_Photo::get_DB_LikeList($photoId);
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
            V_Home::bannedHome();
            return false;
        }
        if (!E_Photo::is_TheUploader($_SESSION["username"], $photoId)) {
            V_Home::notAllowed(E_Photo::get_MostLiked($_SESSION["username"], $this->role), $_SESSION["username"]);
            return false;
        }
        if (!E_Album::is_TheCreator($_SESSION["username"], $newAlbumId)) {
            V_Home::notAllowed(E_Photo::get_MostLiked($_SESSION["username"], $this->role), $_SESSION["username"]);
            return false;
        }
        E_Photo::move_To($photoId, $newAlbumId);
        V_Album::album(E_Album::get_By_ID($newAlbumId), E_Photo::get_By_ID($photoId, $_SESSION["username"], $this->role), $_SESSION["username"]);
        return true;
    }

    /**
     * This method is used to show the homepage with the thumbnails of the most liked photos.
     * 
     * @return boolean true is the homepage was correctly view.
     */
    public function mostLiked() {
        if ($this->isBanned($this->role)) {
            V_Home::bannedHome();
            return false;
        }
        V_Home::standardHome(E_Photo::get_MostLiked($_SESSION["username"], $this->role), $_SESSION["username"]);
        return true;
    }

}
