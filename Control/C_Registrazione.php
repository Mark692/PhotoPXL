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
        $view = new \View\V_Login();
        return $view->display('registrazione.tpl');
    }


    /**
     * 
     * ritorna il tpl relativo al home ospite
     * @return tpl
     */
    public function modulo()
    {
        $view = new \View\V_Login();
        return $view->display('home_ospite.tpl');
    }


    /**
     * funzione per salvare un utente che si registra
     */
    public function save_user()
    {
        $view = new \View\V_Registazione();
        $dati = $view->get_Dati();

        $username = $dati['username'];
        $password = $dati['password'];
        $email = $dati['email'];

        try
        {
            $e_userSTD = new \Entity\E_User_Standard($username, $password, $email);
        }
        catch (\Exceptions\input_texts $ex)
            {
            //Primo catch: gestire username non validi
            $view->assign('messaggio',$ex->getMessage());
            $this->modulo_registrazione();
            }
        catch (\Exceptions\InvalidInput $ex)
            {
            //Primo catch: gestire username non validi
            $view->assign('messaggio',$ex->getMessage());
            $this->modulo_registrazione();
            
            }
        
            \Foundation\F_User::insert($e_userSTD);
    }

}