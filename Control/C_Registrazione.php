
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Control;

class C_Registrazione
{
    /**
     *
     * ritorna il tpl relativo alla registrazine
     * @return tpl
     */
    public function modulo_registrazione()
    {
        $V_Login = new \View\V_Login;
        return $V_Login->fetch('registrazione.tpl');
    }


    /**
     * funzione per salvare un utente che si registra
     */
    public function save_user()
    {
        $v_registrazione = new \View\V_Registazione();
        $dati = $v_registrazione->get_Dati();

        $username = $dati['username'];
        $password = $dati['password'];
        $email = $dati['email'];

        try
        {
            try
            {
                $e_userSTD = new \Entity\E_User_Standard($username, $password, $email);
            }
            catch (\Exceptions\input_texts $ex)
            {
                //Primo catch: gestire username non validi
                $v_registrazione->assign('messaggio', $ex->getMessage());
                $this->modulo_registrazione();
            }
        }
        catch (\Exceptions\input_texts $ex)
        {
            //Secondo catch: gestire email non valide
            $v_registrazione->assign('messaggio', $ex->getMessage());
            $this->modulo_registrazione();
        }

        \Foundation\F_User::insert($e_userSTD);
        return $v_registrazione->fetch('registrazione_ok');
    }


    public function smista()
    {
        $V_Home = new \View\V_Home();
        Switch ($V_Home->getTask())
        {
            case 'registrazione':
                return $this->modulo_registrazione();

            case 'salva':
                return $this->save_user();
        }
    }


}