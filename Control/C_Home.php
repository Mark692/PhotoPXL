<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Control;

class C_Home
{
    /**
     * Imposta la Home page in base a fatto che si è loggati oppure no
     */
    public function Set_page()
    {
        $V_Home = new \View\V_Home();
        $U_Session = new \Utilities\U_Session();
        $username = $U_Session->get_val('username');
        $role = $U_Session->get_val('role');
        $U_Cookie = new \Utilities\U_Cookie;
        $U_Cookie->set_Cookie(); //setta un cookie per verificare che il browser accetta i cookie
        if($U_Cookie->check_Cookie())
        {
            $user_role = \Foundation\F_User::get_Role($username);
            if($role === $user_role)
            {
                $contenuto = $this->smista();
                $V_Home->assign('username', $username);
                $cont = $V_Home->set_Bar($role);
                $V_Home->assign('sidebar', $cont);
                $V_Home->set_Contenuto($contenuto);
                $V_Home->set_home();
            }
            else
            {
                $U_Session->session_destroy();
            }
        }
        else
        {
            //ritorna un tpl che spieghi come abilitare i cookie
        }
    }


    /**
     * ritorna una vista della home in base al fatto che sia loggato oppure no
     * @return type
     */
    public function ritornaHome()
    {
        $VHome = new \View\V_Home();
        $session = new \Utilities\U_Session();
        if($session->get_val('username' !== FALSE))
        {
            return $VHome->fetch('home_loggato');
        }
        else
        {
            return $VHome->fetch('home_ospite');
        }
    }


    /**
     * 
     * Assegna a smarty l'elenco delle 
     * ultime 16 foto caricate
     */
    public function assegna_foto()
    {
        $V_Home = new \View\V_Home();
        $F_Photo = new \Foundation\F_Photo;
        $foto = $F_Photo->get_MostLiked();
        $V_Home->assign('foto_home', array_chunk($foto, PHOTOS_PER_ROW));
    }


    /**
     * Smista le richieste ai vari controller
     * @return mixed
     */
    public function smista()
    {
        $V_Home = new \View\V_Home();
        $controller = $V_Home->getController();
        Switch ($controller)
        {
            case 'Registrazione':
                $C_Registrazione = new \Control\C_Registrazione;
                return $C_Registrazione->smista();
            case 'Login':
                $C_Login = new \Control\C_Login();
                return $C_Login->smista();
            case 'Photo':
                $C_Photo = new \Control\C_Photo();
                return $C_Photo->smista();
            case 'User':
                $C_User = new \Control\C_User;
                return $C_User->smista();
            case 'Profilo':
                $C_Profilo = new \Control\C_Profilo();
                return $C_Profilo->smista();
            case 'Album':
                $C_Album = new \Control\C_Album();
                return $C_Album->smista();
            case 'Mod':
                $C_Mod = new \Control\C_Mod();
                return $C_Mod->smista();
            case 'Cerca':
                $C_Cerca = new \Control\C_Cerca();
                return $C_Cerca->smista();
            case 'Amministartore':
                $C_Amministratore = new \Control\C_Amministratore();
                return $C_Amministratore->smista();
            default :
                return $this->ritornaHome();
        }
    }


}