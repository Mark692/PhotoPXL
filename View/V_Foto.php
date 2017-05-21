<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace View;

class V_Foto extends V_Home
{
    // METODI STATICI \\
    /**
     * Questo metodo viene utilizzato per vedere una foto, assegna a smarty i dati dell'utente e il percorso della foto
     * @param type $array_user
     * @param type $photo
     */
    public static function showPhotoPage()
    {
        $v = new \View\V_Basic();
        $home = new \View\V_Home();
        $id = $_SESSION('id');
        $username = $_SESSION('username');
        $photo = \Entity\E_Photo::get_By_ID($id, $username, $role=$_SESSION('role'));
        $v->assign('photo_deteils', $photo);
        //quale funzione mi da i dati della foto??quale titolo etc-....????
        //$categories = $this->imposta_categoria($photo['categories']);
        //$this->assign('categories', $categories);
        $role = $v->imposta_ruolo($_SESSION('role'));
        $home->home_default($role, 'ShowPhotoUser');
    }


    /**
     * Questo metodo viene utilizzato per richiamare il modulo di upload di una foto
     * @param type $array_user
     * @param type $photo
     */
    public static function showUploadPhoto()
    {
        $v = new \View\V_Basic();
        $home = new \View\V_Home();
        $username = $_SESSION('username');
        $role=$v->imposta_ruolo($_SESSION('role'));
        $array_categories = $home->imposta_categoria();
        $v->assign('username', $username);
        $v->assign('array_categories', $array_categories);
        if($_SESSION('role') == \Utilities\Roles::STANDARD)
        {
            $home->home_default($role, $tpl = 'upload_standard');
        }
        else
        {
            $this->home_default($role, $tpl = 'upload');
        }
    }


    //METODI BASE - NON STATICI!!!\\
    /**
     * Grazie a questa funzione all'interno della variabile $dati_reg vengono
     * registrati tutti i dati inviati tramite POST dal modulo di registrazione
     *
     * @return array
     */
    public function get_Dati()
    {
        $keys = array ('title', 'description', 'is_reserved', 'categories', 'album_id');
        return parent::get_Dati($keys);
    }


    /**
     * Questa funzione, restituisce l'id della foto inviato all'interno del vettore
     * superglobale $_REQUEST
     */
    public function getID()
    {
        if(isset($_REQUEST['id']))
        {
            return $_REQUEST['id'];
        }
    }


    /**
     * mostra il modulo tpl per la modifica dei dati di una foto
     */
    public function showEditPhoto($array_user, $photo)
    {

        $this->assign('user_details', $array_user);
        $this->assign('photo_deteils', $photo);
        $role = $this->imposta_ruolo($array_user['role']);
        $this->assign('role', $role);
        $this->home($role, $tpl = 'EditPhoto');
    }


}