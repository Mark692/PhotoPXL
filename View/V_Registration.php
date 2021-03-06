<?php

/**
 * @access public
 * @package View
 */

namespace View;

/**
 * Questa classe gestisce le varie viste relative al Login e alla Registrazione
 */
class V_Registration extends V_Home
{
    // METODI STATICI \\
    /**
     * Mostra la home page con messsaggio di errore = Ops...Hai sbagliato username o password'
     *
     */
    public static function error_registration()
    {
        $home = new V_Home();
        $home->set_banner($tpl = 'banner_error_registration');
        $home->assign('foto', "templates/main/template/img/noimagefound.jpg");
        $home->set_Cont_menu_user($role = 'guest');
        $home->set_Contenuto_Home($tpl = 'registration');
        $home->display('home_default.tpl');
    }
    
    /**
     * Mostra la home page con messsaggio di errore = Ops...Hai sbagliato username o password'
     *
     */
    public static function error_login()
    {
        $home = new V_Home();
        $home->set_banner($tpl = 'banner_error_registration');
        $home->assign('foto', "templates/main/template/img/noimagefound.jpg");
        $home->set_Cont_menu_user($role = 'guest');
        $home->set_Contenuto_Home($tpl = 'login');
        $home->display('home_default.tpl');
    }


    // METODI NON STATICI \\
}