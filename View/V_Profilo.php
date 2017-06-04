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
    //METODI STATICI\\
    //A BENEDETTA SERVE LA FUNZIONE STATICA ::home() pagina profilo con la LISTA (THUMBNAIL = MINIATURE) degli album/foto
    /*
     * Funzione che restiuisce il template della pagina del profilo con la thumbnail degli album e i dati utente
     *
     * @param type $username  username di sessione
     * @param type $user_datails  i dati dell'utente di cui si sta guardando il profilo
     * @param type $array_photo  thumbnail degli album/foto di un utente
     */
    public static function home($username, $user_details, $array_photo)
    {
        $home = new \View\V_Home();
        $details = $home->user_details($user_details);
        $home->assign('user_details', $details);
        $home->show_profile_pic(\Entity\E_User::get_ProfilePic($details['username']));
        $home->assign('username', $username);
        if($username === $details['username'])
        {
            $home->assign('attiva', TRUE);
        }
        $home->CheckPhotos($array_photo);
        $home->set_Cont_menu_user($home->imposta_ruolo(\Entity\E_User::get_DB_Role($username)));
        $home->set_Contenuto_Home($tpl = 'ShowProfile');
        $home->display('home_default.tpl');
    }


    /*
     * funzione che restituisce la home con banner di azione avvenuta con successo
     *
     * @param array $array_photo foto con + like
     * @param string $user_name i dati dell'utente
     */
    public static function banner($array_photo, $username)
    {
        $home = new V_Home();
        $home->set_banner($tpl = 'banner_ok');
        $home->assign('username', $username);
        $home->CheckPhotos($array_photo);
        $home->assign('categories', $home->imposta_categoria());
        $home->set_Cont_menu_user($home->imposta_ruolo(\Entity\E_User::get_DB_Role($username)));
        $home->set_Contenuto_Home($home->set_home($username));
        $home->display('home_default.tpl');
    }


    /**
     * mostra il modulo tpl per la modifica dei dati del profilo
     *
     * @param Entity\E_User* $user_details i dati dell'utente presi da DB
     * @param array $array_photo foto con + like
     */
    public static function showEditProfile($user_details, $array_photo)
    {
        $home = new \View\V_Home();
        $details = $home->user_details($user_details);
        $home->assign('user_details', $details);
        $home->show_profile_pic(\Entity\E_User::get_ProfilePic($details['username']));
        $home->assign('username', $details['username']);
        $home->CheckPhotos($array_photo);
        $home->set_Cont_menu_user($details['role']);
        $home->set_Contenuto_Home($tpl = 'EditProfile');
        $home->display('home_default.tpl');
    }


    //METODI BASE - NON STATICI!!!\\
}