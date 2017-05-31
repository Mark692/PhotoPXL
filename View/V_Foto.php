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
     * Questo metodo viene utilizzato per vedere una foto, assegna a smarty 
     * i dati dell'utente e il percorso della foto
     * 
     * @param type $photo Description la foto con fullsize type e id
     * @param type $username 
     * 
     */
    public static function showPhotoPage($photo, $username)
    {
        $home = new \View\V_Home();
        //i dettagli di photo come titolo etc è un oggetto
        $home->assign('username', $username);
        $photo_details = $home->photo_details($photo);
        $home->assign('photo_details', $photo_details);
        $home->showimage($photo);
        $home->assign('comments', \Entity\E_Comment::get_By_Photo($photo_details['id']));
        $likelist = $photo["photo"]->get_LikesList();
        foreach($likelist as $user)
        {
            if($user['username'] !== $username)
            {
                $home->assign('assegna', 'TRUE');
            }
        }
        $home->set_Cont_menu_user($home->imposta_ruolo(\Entity\E_User::get_DB_Role($username)));
        $home->set_Contenuto_Home($tpl = 'ShowPhotoUser');
        $home->display('home_default.tpl');
    }


    /**
     * Questo metodo viene utilizzato per richiamare il modulo di upload di una foto
     * @param type $username
     */
    public static function showUploadPhoto($username)
    {
        $home = new \View\V_Home();
        if(\Entity\E_User::get_DB_Role($username) === \Utilities\Roles::STANDARD)
        {
            $tpl = 'upload_standard';
        }
        else
        {
            $tpl = 'upload';
        }
        $home->assign('username', $username);
        $home->assign('array_categories', $home->imposta_categoria());
        $home->set_Cont_menu_user($home->imposta_ruolo(\Entity\E_User::get_DB_Role($username)));
        $home->set_Contenuto_Home($tpl);
        $home->display('home_default.tpl');
    }

    /**
     * mostra una vista per la modifica dei dati di una foto
     * @param type $photo Description la foto con fullsize type e id
     * @param type $username  
     */
    public static function showEditPhoto($photo, $username)
    {
        $home = new \View\V_Home();
        $home->assign('username', $username);
        $photo_details = $home->photo_details($photo);
        $home->assign('photo_details',$photo_details);
        $home->showimage($photo);
        $home->assign('array_categories', $home->imposta_categoria());
        $home->assign('role',\Entity\E_User::get_DB_Role($username));
        $home->set_Cont_menu_user($home->imposta_ruolo(\Entity\E_User::get_DB_Role($username)));
        $home->set_Contenuto_Home($tpl = 'EditPhoto');
        $home->display('home_default.tpl');
    }


    //METODI BASE - NON STATICI!!!\\
    /**
     * Grazie a questa funzione all'interno della variabile $dati_reg vengono
     * registrati tutti i dati inviati tramite POST dal modulo di registrazione
     *
     * @return array
     *
      public function get_Dati()
      {
      $keys = array ('title', 'description', 'is_reserved', 'categories', 'album_id');
      return parent::get_Dati($keys);
      }


      /**
     * Questa funzione, restituisce l'id della foto inviato all'interno del vettore
     * superglobale $_REQUEST
     *
      public function getID()
      {
      if(isset($_REQUEST['id']))
      {
      return $_REQUEST['id'];
      }
      }
     *
     * 
     */
    /**
     * mostra il modulo tpl per la modifica dei dati di una foto
     */
}