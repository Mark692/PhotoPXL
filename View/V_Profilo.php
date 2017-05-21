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

use Entity\E_User;
use Entity\E_Album;
use View\V_Home;

class V_Profilo extends V_Home
{
    //METODI STATICI -> CONTROL\\
    //A BENEDETTA SERVE LA FUNZIONE STATICA ::home() pagina profilo con la LISTA (THUMBNAIL = MINIATURE) degli album/foto
    /*
     * Funzione che restiuisce il template della pagina del profilo con la thumbnail degli album e i dati utente
     */
    public static function home()
    {
        $v = new \View\V_Basic();
        $home = new \View\V_Home();
        $username = $_SESSION["username"];
        $v->assign('username', $username);
        $role = $v->imposta_ruolo($_SESSION["role"]);
        $array_user = \Entity\E_User::get_UserDetails($username);
        $pic_profile = \Entity\E_User::get_ProfilePic($username);
        $array_album = \Entity\E_Album::get_By_User($username);
        //mettere in ordine le thumbanil degli album da passare a smarty
        $v->assign('array_album', $array_album);
        $v->assign('user_details', $array_user);
        $v->assign('pic_profile', $pic_profile);
        //$v->assign('thumbnail', $thumbnail);//vanno assegnate le miniature dell'album da verificare
        $home->home_default($role, $tpl = 'ShowProfile');
    }


    //A BENEDETTA SERVE LA FUNZIONE STATICA ::banner() DEVE AVVERTIRE L'UTENTE CHE L'AZIONE è AVVENUTA CON SUCCESSO
    /*
     * funzione che restituisce la home con banner di azione avvenuta con successo
     */
    public static function banner()
    {
        $v = new V_Basic();
        $banner = $v->fetch('banner_ok.tpl');
        $v->assign('$banner', $banner);
        \View\V_Home::standardHome();
    }


    /**
     * mostra il modulo tpl per la modifica dei dati del profilo
     */
    public static function showEditProfile()
    {

        $v = new \View\V_Basic();
        $home = new \View\V_Home();
        $username = $_SESSION["username"];
        $v->assign('username', $username);
        $role = $v->imposta_ruolo($_SESSION["role"]);
        $array_user = \Entity\E_User::get_UserDetails($username);
        $pic_profile = \Entity\E_User::get_ProfilePic($username);
        $array_album = \Entity\E_Album::get_By_User($username);
        //mettere in ordine le thumbanil degli album da passare a smarty
        $v->assign('array_album', $array_album);
        $v->assign('user_details', $array_user);
        $v->assign('pic_profile', $pic_profile);
        //$v->assign('thumbnail', $thumbnail);//vanno assegnate le miniature dell'album da verificare
        $v->assign('role', $role);
        $home->home($role, $tpl = 'EditProfile');
    }


    //METODI BASE - NON STATICI!!!\\
    /**
     * Grazie a questa funzione all'interno della variabile $dati vengono
     * registrati tutti i dati inviati tramite POST dal modulo di modifica del profilo
     *
     * @return array
     */
    public function get_Dati()
    {
        $keys = array ('username', 'page_toView', 'page_tot', 'order', 'email', 'tmp_name', 'size', 'type');
        return parent::get_Dati($keys);
    }


}