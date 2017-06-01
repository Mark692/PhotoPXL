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
     * @param type $username Description username di sessione
     * @param type $user_datails Description i dati dell'utente di cui si sta guardando il profilo
     * @param type $array_photo Description thumbnail degli album/foto di un utente
     */
    public static function home($username, $user_details, $array_photo)
    {
        $home = new \View\V_Home();
        $profile_user = $user_details->get_Username();
        $profile_email = $user_details->get_Email();
        $profile_role = $home->imposta_ruolo($user_details->get_Role());
        $home->show_profile_pic(\Entity\E_User::get_ProfilePic($profile_user));
        $home->assign('username', $username);
        if($username === $profile_user)
        {
            echo('sono lo stesso');
            $home->assign('attiva', TRUE);
        }

        $home->assign('profile_user', $profile_user);
        $home->assign('profile_email', $profile_email);
        $home->assign('profile_role', $profile_role);
        $home->assign('array_photo', $home->thumbnail($array_photo));
        $home->set_Cont_menu_user($home->imposta_ruolo(\Entity\E_User::get_DB_Role($username)));
        $home->set_Contenuto_Home($tpl = 'ShowProfile');
        $home->display('home_default.tpl');
    }


    /*
     * funzione che restituisce la home con banner di azione avvenuta con successo
     *
     * @param type $array_photo Description foto con + like
     * @param type $user_name Description i dati dell'utente
     */
    public static function banner($array_photo, $username)
    {
        $home = new V_Home();
        $home->set_banner($tpl = 'banner_ok');
        $home->assign('username', $username);
        $home->assign('array_photo', $home->thumbnail($array_photo));
        $categories = $home->imposta_categoria();
        $home->assign('categories', $categories);
        $home->set_Cont_menu_user($home->imposta_ruolo(\Entity\E_User::get_DB_Role($username)));
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
        //da sistema
        $home = new \View\V_Home();
        $home->assign('user_details', $user_datails);
        $home->assign('array_photo', $home->thumbnail($array_photo));
        $role = $home->imposta_ruolo($user_datails['role']);
        $home->set_Cont_menu_user($role);
        $home->set_Contenuto_Home($tpl = 'EditProfile');
        $home->assign('array_photo', $home->thumbnail($array_photo)); //SISTEMA STA MERDA
        //A CHE SERVE CHE FAI DUE VOLTE STA COSA???
        //GUARDA 4 RIGHE PIù SOPRA E TROVI LA STESSA IDENTICA COSA
        $home->display('home_default.tpl');
    }


    //METODI BASE - NON STATICI!!!\\
}