<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace View;

class V_Foto extends V_Home
{
    /**
     * Grazie a questa funzione all'interno della variabile $dati_reg vengono
     * registrati tutti i dati inviati tramite POST dal modulo di registrazione
     *
     * @return array
     */
    public static function get_Dati()
    {
        $keys = array ('title', 'description', 'is_reserved', 'categories', 'album_id');
        return parent::get_Dati($keys);
    }


    /**
     * Questa funzione, restituisce l'id della foto inviato all'interno del vettore
     * superglobale $_REQUEST
     */
    public static function getID()
    {
        if(isset($_REQUEST['id']))
        {
            return $_REQUEST['id'];
        }
    }


    /**
     * Questo metodo viene utilizzato per vedere una foto, assegna a smarty i dati dell'utente e il percorso della foto
     * @param type $array_user
     * @param type $photo
     */
    public static function showPhotoPage($array_user, $photo)
    {
        $this->assign('photo_deteils', $photo);
        //$categories = $this->imposta_categoria($photo['categories']);
        //$this->assign('categories', $categories);
        $this->assign('user_details', $array_user);
        $role = $this->imposta_ruolo($array_user['role']);
        $this->home($role, $tpl = 'ShowPhotoUser');
    }


    /**
     * Questo metodo viene utilizzato per richiamare il modulo di upload di una foto
     * @param type $array_user
     * @param type $photo
     */
    public static function showUploadPhoto($role)
    {
        $array_categories = $this->imposta_categoria();
        $role = $this->imposta_ruolo($role);
        $this->assign('array_categories', $array_categories);
        if($role == \Utilities\Roles::STANDARD)
        {
            $this->home($role, $tpl = 'upload_standard');
        }
        else
        {
            $this->home($role, $tpl = 'upload');
        }
    }


    /**
     * mostra il modulo tpl per la modifica dei dati di una foto
     */
    public static function showEditProfile($array_user, $photo)
    {

        $this->assign('user_details', $array_user);
        $this->assign('photo_deteils', $photo);
        $role = $this->imposta_ruolo($array_user['role']);
        $this->assign('role', $role);
        $this->home($role, $tpl = 'EditPhoto');
    }


}