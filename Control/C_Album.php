<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
    public function see($albumId) {
        $role = E_User::get_DB_Role($_SESSION["username"]);
        if ($role == Roles::BANNED) {
            V_Home::bannedHome();
            return false;
        }
        $album = E_Album::get_By_ID($albumId);
        V_Album::album($album, E_Photo::get_By_Album($albumId, $_SESSION["username"], $role)); // Per Federico
    }
    
    /**
     * This method is used to see more content of an album if the element are more than 16.
     * 
     * @param int $albumId the album id
     * @param int $pageToView the next page to view
     * @return boolean true if the user's allowed to see the album
     */
    public static function seeAsync($albumId, $pageToView){
        $role = E_User::get_DB_Role($_SESSION["username"]);
        if ($role == Roles::BANNED) {
            return false;
        }
        $album = E_Album::get_By_ID($albumId);
        return E_Photo::get_By_Album($album, $_SESSION["username"], $role, $pageToView);
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
    public function edit($albumId, $title, $categories, $description) {
        foreach ($categories as $category) {
            if ($category != PAESAGGI and $category != RITRATTI and $category != FAUNA
                    and $category != BIANCONERO and $category != ASTRONOMIA and
                    $category != STREET and $category != NATURAMORTA and $category != SPORT) {
                return false;
            }
        }
        $role = E_User::get_DB_Role($_SESSION["username"]);
        if ($role == Roles::BANNED) {
            V_Home::bannedHome();
            return false;
        }
        if(!E_Album::is_TheCreator($_SESSION["username"], $albumId)){
            V_Home::notAllowed();
            return false;
        }
        $album = E_Album::get_By_ID($albumId);
        /* @var $album \Entity\E_Album */
        $album->set_Title($title);
        $album->set_Categories($categories);
        $album->set_Description($description);
        E_Album::update_Details($album);
        return true;
    }

    /**
     * This method is used to delete an album with or without its photos
     *  
     * @param int $albumId the album id
     * @param boolean $withPhotos true if also the photos have to be deleted
     * @return boolean true if the album was correctly deleted
     */
    public function delete($albumId, $withPhotos) {
        $role = E_User::get_DB_Role($_SESSION["username"]);
        if ($role == Roles::BANNED) {
            V_Home::bannedHome();
            return false;
        }
        if(!E_Album::is_TheCreator($_SESSION["username"], $albumId)){
            V_Home::notAllowed();
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
    public function create($title, $categories, $description) {
        $role = E_User::get_DB_Role($_SESSION["username"]);
        if ($role == \Utilities\Roles::BANNED) {
            V_Home::bannedHome();
            return false;
        }
        $album = new E_Album($title, $description, $categories, time());
        E_Album::insert($album, $_SESSION["username"]);
    }

}
