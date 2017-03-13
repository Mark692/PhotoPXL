<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Control;

/**
 * This class menage the actions a user can do about the albums.
 *
 * @author Benedetta
 */
class C_Album {

    public function see($albumId) {
        $role = \Entity\E_User::get_DB_Role($_SESSION["username"]);
        if($role == \Utilities\Roles::BANNED){
            \View\V_Home::bannedHome();
            return false;
        }
        $album = \Entity\E_Album::get_By_ID($albumId);
        \View\V_Album::album($album, 
                \Entity\E_Photo::get_By_Album($albumId, $_SESSION["username"], $role)); // Per Federico
    }

    public function edit($albumId, $title, $categories, $description) {
        foreach ($categories as $category) {
            if ($category != PAESAGGI and $category != RITRATTI and $category != FAUNA
                    and $category != BIANCONERO and $category != ASTRONOMIA and
                    $category != STREET and $category != NATURAMORTA and $category != SPORT) {
                return false;
            }
        }
        $album = \Entity\E_Album::get_By_ID($albumId);
        /* @var $album \Entity\E_Album */
        $album->set_Title($title);
        $album->set_Categories($categories);
        $album->set_Description($description);
        \Entity\E_Album::update_Details($album);
        return true;
    }

    public function delete($albumId, $withPhotos) {
        if ($withPhotos) {
            \Entity\E_Album::delete_Album_AND_Photos($album_ID);
        } else {
            \Entity\E_Album::delete($album_ID);
        }
        return true;
    }

    public function create($title, $categories, $description) {
        // Un utente va nella sua pagina profilo e clicca su "crea album", in cui
        // poi può aggiungere foto, aggiungere titlo, categorie e descrizione
    }

}
