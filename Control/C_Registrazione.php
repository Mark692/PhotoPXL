<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Control;

class C_Registrazione
{


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
            \Foundation\F_User::insert($e_userSTD);
        }
        catch (\Exceptions\InvalidInput $ex)
        {
            echo($ex->getMessage()); //LANCIA TEMPLATE PER GESTIRE ERRORE
        }
        //RITORNA IL TEMPLATE ALLA REGISTRAZIONE
    }

}