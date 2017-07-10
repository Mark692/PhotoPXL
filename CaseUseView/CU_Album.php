<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CaseUseView;

/**
 * Questa classe si occupa di testare metodi di classe di V_Album
 */
class CU_Album
{
    /**
     * restituisce la vista delle thumbanil di un album
     * @param string $id l'id dell'album
     * @param string $username l'utente loggato
     */
    public function album($id,$username)
    {

        $role = \Entity\E_User::get_DB_Role($username);
        $DB_album = \Entity\E_Album::get_By_ID($id);
        if(!empty($DB_album))
        {
        $array_photo = \Entity\E_Photo::get_By_Album($id, $username, $role);
        \View\V_Album::album($DB_album, $array_photo, $username);
        }
        else{
            $home=new \CaseUseView\CU_Home();
            $home->error($username);
        }
    }


}