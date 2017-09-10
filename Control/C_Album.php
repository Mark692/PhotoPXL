<?php

namespace Control;

use Entity\E_User;
use Entity\E_Album;
use Entity\E_Photo;
use View\V_Home;
use View\V_Album;
use Utilities\Roles;

/**
 * This class menages the actions a user can do about the albums.
 *
 * @author Benedetta
 */
class C_Album {

    /**
     * This method is used to see the content of the album
     * 
     * @param int $albumId the album id
     * @return boolean true if the user's allowed to see the album
     */
    public static function see($albumId) {
        $role = E_User::get_DB_Role($_SESSION["username"]);
        if ($role == Roles::BANNED) {
            header("Location: /index.php");
            exit();
        }
        $album = E_Album::get_By_ID($albumId);
        if(!$album) {
            header("Location: /error.php");
            exit();
        }
        V_Album::album($album, E_Photo::get_By_Album($albumId, $_SESSION["username"], $role), $_SESSION["username"]);
    }

    /**
     * 
     * This method is used to edit title, categories and description of an album
     * 
     * @param int $albumId the album id
     * @param string $title the album title
     * @param array $categories the album categories
     * @param string $description the album description
     * @return boolean true if the album was correctly edit
     */
    public static function edit($albumId, $title, $categories, $description) {
        $role = E_User::get_DB_Role($_SESSION["username"]);
        if ($role == Roles::BANNED) {
            V_Home::bannedHome();
            return false;
        }
        if (is_null($categories)){
            $categories = [];
        }
        foreach ($categories as $category) {
            if ($category != PAESAGGI and $category != RITRATTI and $category != FAUNA
                    and $category != BIANCONERO and $category != ASTRONOMIA and
                    $category != STREET and $category != NATURAMORTA and $category != SPORT) {
                return false;
            }
        }
        if (!E_Album::is_TheCreator($_SESSION["username"], $albumId)) {
            V_Home::notAllowed(E_Photo::get_MostLiked($_SESSION["username"], $role), $_SESSION["username"]);
            return false;
        }
        $album = E_Album::get_By_ID($albumId);
        /* @var $album \Entity\E_Album */
        $album->set_Title($title);
        $album->set_Categories($categories);
        $album->set_Description($description);
        E_Album::update_Details($album);
        V_Album::album($album, E_Photo::get_By_Album($albumId, $_SESSION["username"], $role), $_SESSION["username"]);
        return true;
    }

    /**
     * This method is used to delete an album with or without its photos
     *  
     * @param int $albumId the album id
     * @param boolean $withPhotos true if also the photos have to be deleted
     * @return boolean true if the album was correctly deleted
     */
    public static function delete($albumId, $withPhotos) {
        $role = E_User::get_DB_Role($_SESSION["username"]);
        if ($role == Roles::BANNED) {
            header("Location: /index.php");
            exit();
        }
        if (!E_Album::is_TheCreator($_SESSION["username"], $albumId)) {
                        return false;
        }
        if ($withPhotos) {
            E_Album::delete_Album_AND_Photos($albumId);
        } else {
            E_Album::delete($albumId);
        }
        return true;
    }

    /**
     * This methos is used to create a new album
     * 
     * @param string $title the album title
     * @param array $categories the album categories
     * @param string $description the album description
     * @return boolean true if the album was correctly created
     */
    public static function create($title, $categories, $description) {
        $role = E_User::get_DB_Role($_SESSION["username"]);
        if ($role == \Utilities\Roles::BANNED) {
            header("Location: /index.php");
            exit();
        }
        if (is_null($categories)){
            $categories = [];
        } else {
            $categories = array_map('intval', $categories);
        }
        $album = new E_Album($title, $description, $categories, time());
        return E_Album::insert($album, $_SESSION["username"]);
        
    }

}
