<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * @access public
 * @package View
 */

namespace View;

class V_Profilo extends V_Home
{
    //METODI STATICI -> CONTROL\\
    //A BENEDETTA SERVE LA FUNZIONE STATICA ::home() pagina profilo con la LISTA (THUMBNAIL = MINIATURE) degli album/foto
    /*
     * Funzione che restiuisce il template della pagina del profilo con la thumbnail degli album e i dati utente
     * 
     * @param type $user_datails Description i dati dell'utente
     * @param type $array_photo Description foto con + like
     */
    public static function home($username, $album_thumbnail)
    {
        $home = new \View\V_Home();
        //mettere in ordine le thumbanil degli album da passare a smarty
        $home->assign('array_album', $album_thumbnail);
        $home->assign('user_details', $user_datails);
        $thumbnail = $home->thumbnail($album_thumbnail);
        $home->set_Cont_menu_user($home->imposta_ruolo($user_datails['role']));
        $home->set_Contenuto_Home($tpl = 'ShowProfile');
        $home->display('home_default.tpl');
    }


    /*
     * funzione che restituisce la home con banner di azione avvenuta con successo
     * 
     * @param type $user_datails Description i dati dell'utente
     * @param type $array_photo Description foto con + like
     */
    public static function banner($username, $array_photos)
    {
        $home = new V_Home();
        $home->set_banner($tpl = 'banner_ok.tpl');
        $home->assign('username', $username);
        $thumbnail = $home->thumbnail($array_photos);
        $home->assign('thumbnail', $thumbnail);//{$thumbnail} nel tempalte
        $role = $home->imposta_ruolo(\Entity\E_User::get_DB_Role($username));
        $home->set_Cont_menu_user($role);
        $home->set_Contenuto_Home($home->set_home($username));
        $home->display('home_default.tpl');
    }


    /**
     * mostra il modulo tpl per la modifica dei dati del profilo
     * 
     * @param type $user_datails Description i dati dell'utente
     * @param type $array_photo Description foto con + like
     */
    public static function showEditProfile($user_datails, $array_photo)
    {

        $home = new \View\V_Home();
        $home->assign('user_details', $user_datails);
        $home->assign('array_photo', $home->thumbnail($array_photo));
        $role = $home->imposta_ruolo($user_datails['role']);
        $home->set_Cont_menu_user($role);
        $home->set_Contenuto_Home($tpl = 'EditProfile');
        $home->assign('array_photo', $home->thumbnail($array_photo));
        $home->display('home_default.tpl');
    }


    //METODI BASE - NON STATICI!!!\\
    /**
     * Grazie a questa funzione all'interno della variabile $dati vengono
     * registrati tutti i dati inviati tramite POST dal modulo di modifica del profilo
     *
     * @return array

      public function get_Dati()
      {
      $keys = array ('username', 'page_toView', 'page_tot', 'order', 'email', 'tmp_name', 'size', 'type');
      return parent::get_Dati($keys);
      }
     */
}