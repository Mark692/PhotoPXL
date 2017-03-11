<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Control;

/**
 * Description of P_Photo
 *
 * @author Benedetta
 */
class C_Photo {

    public function see($photoId) {
        \View\V_Foto::showPhotoPage(\Entity\E_User::get_UserDetails($_SESSION["username"]), 
                \Entity\E_Photo::get_By_ID($photoId, $_SESSION["username"], 
                        \Entity\E_User::get_DB_Role($_SESSION["username"])));
        //per Federico
    }

    public function edit($photoId, $title, $categories, $description) {
        foreach ($categories as $category) {
            if ($category != PAESAGGI and $category != RITRATTI and $category != FAUNA
                    and $category != BIANCONERO and $category != ASTRONOMIA and
                    $category != STREET and $category != NATURAMORTA and $category != SPORT) {
                return false;
            }
        }

        $photo = \Entity\E_Photo::get_By_ID($photoId, $_SESSION['username'], 
                \Entity\E_User::get_DB_Role($_SESSION["username"]));
        /* @var $photo \Entity\E_Photo */
        $photo->set_Title($title);
        $photo->set_Categories($categories);
        $photo->set_Description($description);
        \Entity\E_Photo::update($photo);

        return true;
    }

    public function upload($photoPath, $title, $categories, $description, $albumId = null) {
        $photo_blob = new \Entity\E_Photo_Blob();
        $photo_blob->on_Upload($photoPath); //$_FILES['userfile']['tmp_name']; in service
        $photo = new \Entity\E_Photo($title);
        $photo->set_Categories($categories);
        $photo->set_Description($description);
        $photoId = \Entity\E_Photo::insert($photo, $photo_blob, $_SESSION["username"]);
        if(!is_null($albumId)){
            \Entity\E_Photo::move_To($albumId, $photoId);
        }
        return true;
    }

    public function comment($photoId, $text) {
        \Entity\E_Comment::insert(new \Entity\E_Comment($text, $_SESSION["username"], $photoId));
    }

    public function likeUnlike($photoId) {
        
    }

    public function delete($photoId) {
        \Entity\E_Photo::delete($photoId);
    }

    public function privacy($photoId) {
        if(\Entity\E_User::get_DB_Role($_SESSION["username"]) == \Utilities\Roles::BANNED
                or \Entity\E_User::get_DB_Role($_SESSION["username"]) == \Utilities\Roles::STANDARD){
            return false;
        }
        //da finire
    }

    public function searchByCategory($category) {
        \Entity\E_Photo::get_By_Categories($category, $_SESSION["username"], 
                \Entity\E_User::get_DB_Role($_SESSION["username"]));
    }

    public function seeComments($photoId) {
        \Entity\E_Photo::get_DB_CommentsList($photoId);
    }

    public function seeLikes($photoId) {
        \Entity\E_Photo::get_DB_LikeList($photoId);
    }

    public function changeAlbum($photoId, $newAlbumId = null) {
        if(!is_null($newAlbumId)){
            \Entity\E_Photo::move_To($newAlbumId, $photoId);
        }
        else;
    }

}
