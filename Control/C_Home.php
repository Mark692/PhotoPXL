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
        $username = $U_Session->get_val('username');
        $role = $U_Session->get_val('role');
        $contenuto = $this->smista();
        if($username !== FALSE)
        {
            if($role !== \Utilities\Roles::BANNED)
            {
                echo'sono auenticato';
                $U_Cookie->set_Cookie(); //verifica i cookie
                $V_Home->assign('username', $username);
                $cont = $V_Home->set_Bar($role);
                $V_Home->assign('sidebar', $cont);
                if($contenuto === FALSE)
                {
                    $this->assegna_foto();
                    $V_Home->fetch('home_log_default.tpl');
                    $V_Home->set_Contenuto($contenuto);
                }
                else
                {
                    $V_Home->set_Contenuto($contenuto);
                }

                $V_Home->set_home();
            }
            else
            {
                $V_Home->set_ban();
            }
        }
        else
        {
            $cont = $V_Home->set_Bar($role);
            $V_Home->assign('sidebar', $cont);
            if($contenuto !== FALSE)
            {
                $V_Home->set_Contenuto($contenuto);
                //per utenti non autenticati role sara FALSE
            }
            else
            {
                $this->assegna_foto();
                $contenuto = $V_Home->fetch('home_ospite.tpl');
                $V_Home->set_Contenuto($contenuto);
            }
            $V_Home->set_home();
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
            case 'registrazione':
                $C_Registrazione = new \Control\C_Registrazione;
                return $C_Registrazione->smista();
            case 'Login':
                $C_Logine = new \Control\C_Login();
                return $C_Login->smista();
            case 'Photo':
                $C_Photo = new \Control\C_Photo();
            default :
                return FALSE;
        }
    }


}