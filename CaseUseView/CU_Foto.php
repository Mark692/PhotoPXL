<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CaseUseView;

/**
 * Questa classe si occupa di testare metodi di classe di V_Foto
 */
class CU_Foto
{
    /**
     * restituisce una pagina con la foto e i suoi dettagli, nel caso in cui non 
     * è possibile visualizzare la foto perchè non si hanno i permessi visualizza
     * un banner
     * 
     * @param type $id l'id della foto 
     * @param type $username l'utente che è loggato
     */
    public function showPhotoPage($id, $username)
    {
        $role = \Entity\E_User::get_DB_Role($username);
        $photo = \Entity\E_Photo::get_By_ID($id, $username, $role);
        if(!empty($photo))
        {
            \View\V_Foto::showPhotoPage($photo, $username);
        }
        else
        {
            $home = new \CaseUseView\CU_Home();
            $home->notAllowed($username);
        }
    }


    /**
     * restituisce una vista in base per upload delle foto in base al fatto che l'utente sia standard o superiore al pro
     * @param string $username utente loggato che vuole fare l'upload
     */
    public function showUploadPhoto($username)
    {
        \View\V_Foto::showUploadPhoto($username);
    }


    /**
     * restituisce una pagina dove è possibile modificare, eliminare una foto 
     * 
     * @param type $id l'id della foto 
     * @param type $username l'utente che è loggato
     */
    public function showEditPhoto($id, $username)
    {
        $role = \Entity\E_User::get_DB_Role($username);
        $photo = \Entity\E_Photo::get_By_ID($id, $username, $role);
        \View\V_Foto::showEditPhoto($photo, $username);
    }


}