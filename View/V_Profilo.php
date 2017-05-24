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
     */
    public static function home($user_datails,$album_thumbnail)
    {
        $home = new \View\V_Home();
        //mettere in ordine le thumbanil degli album da passare a smarty
        $home->assign('array_album', $album_thumbnail);
        $home->assign('user_details', $user_datails);
        //$v->assign('thumbnail', $thumbnail);//vanno assegnate le miniature dell'album da verificare
        $home->set_Cont_menu_user($home->imposta_ruolo($user_datails['role']));
        $home->set_Contenuto_Home($tpl = 'ShowProfile');
        $home->display('home_default.tpl');
    }


    //A BENEDETTA SERVE LA FUNZIONE STATICA ::banner() DEVE AVVERTIRE L'UTENTE CHE L'AZIONE è AVVENUTA CON SUCCESSO
    /*
     * funzione che restituisce la home con banner di azione avvenuta con successo
     */
    public static function banner($user_datails, $array_photo)
    {
        $home = new V_Home();
        $home->set_banner($tpl = 'banner_ok.tpl');
        $home->assign('username', $user_datails['username']);
        $home->assign('array_photo', $array_photo);
        $role = $home->imposta_ruolo($user_datails['role']);
        $home->set_Cont_menu_user($role);
        $home->set_Contenuto_Home($home->set_home($user_datails['username']));
        //$array_photo=$home->thumbnail($array_photo);
        //$v->assign('array_photo',$array_photo);
        $home->display('home_default.tpl');
    }


    /**
     * mostra il modulo tpl per la modifica dei dati del profilo
     */
    public static function showEditProfile($user_datails)
    {

        $home = new \View\V_Home();
        //mettere in ordine le thumbanil degli album da passare a smarty
        $home->assign('user_details', $user_datails);
        //$v->assign('thumbnail', $thumbnail);//vanno assegnate le miniature dell'album da verificare
        $role = $home->imposta_ruolo($user_datails['role']);
        $home->set_Cont_menu_user($role);
        $home->set_Contenuto_Home($tpl = 'EditProfile');
        //$array_photo=$home->thumbnail($array_photo);
        //$v->assign('array_photo',$array_photo);
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