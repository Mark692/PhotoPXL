<?php

/**
 * @access public
 * @package View
 */

namespace View;

class V_Registration extends V_Home
{
    // METODI STATICI \\
    /**
     * visualizza una banner di errore
     */
    //da SISTEMARE!!!
    public static function error_registration()
    {
        $home = new V_Home();
        $home->set_banner($tpl = 'banner_error_registration');
        $home->assign('foto', "templates/main/template/img/noimagefound.jpg");
        $home->set_Cont_menu_user($role = 'guest');
        $home->set_Contenuto_Home($tpl = 'registration');
        $home->display('home_default.tpl');
    }


    // METODI NON STATICI \\
}