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
    public function Set_home()
    {
        $V_Home = new \View\V_Home();
        $U_Session = new \Utilities\U_Session();
        $U_Cookie = new \Utilities\U_Cookie();
        $role = $U_Session->get_val('role');
        if($role != \Utilities\Roles::BANNED)
        {
            $contenuto = $this->smista();
            $this->set_menu();
            $U_Cookie->set_Cookie();
            $this->assegna_foto();
            $V_Home->set_Contenuto($contenuto);
            $V_Home->inserisciContenuto();
            $V_Home->set_home();
        }
        else
        {
            //tpl bannato;
        }
    }


    /**
     * Imposta la topbar in base a tipo di utente
     */
    public function set_menu()
    {
        $V_Home = new \View\V_Home();
        $U_Session = new \Utilities\U_Session();
        $role = $U_Session->get_val('role');
        if($role == '1')
        {
            $V_Home->set_Bar('top_bar_standard');
        }
        elseif($role == '2')
        {
            $V_Home->set_Bar('top_bar_pro');
        }
        elseif($role == '3')
        {
            $V_Home->set_Bar('top_bar_mod');
        }
        elseif($role == '4')
        {
            $V_Home->set_Bar('top_bar_admin');
        }
        elseif(($role == ''))
        {
            $V_Home->set_Bar('top_bar_ospite');
        }
        else
        {
            //lanciare eccezione per ban
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
        $foto = array ();
        $ordinamento = 'decrescente';
        $limit = '16';
        $risultato = $ffoto->//funzione che mi trova le foto in maniera decrescente e limitata
        $view->assign('imege', $risultato);
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
            case 'registrazione':
                $CRegistrazione = new \Control\C_Registrazione;
                return $C_Registrazione->smista();
            case 'Login':
                $CRicerca = new \Control\C_Login();
                return $C_Login->smista();
            default:
                return $this->ritorna_home();
        }
    }


}