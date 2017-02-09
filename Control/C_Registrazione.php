<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Control;

use \Exceptions\InvalidInput;

class C_Registrazione
{


    public function save_user()
    {
        $view = new \View\V_Registazione();
        $dati = $view->get_Dati();

        $username = $dati['username'];
        $password = $dati['password'];
        $email = $dati['email'];

        if($this->details_areValid($username, $email))
        {
            $e_user = new \Entity\E_User_Standard($username, $password, $email);
            \Foundation\F_User::insert($e_user);

            //RITORNA UN TEMPLATE ALLA HOME
        }

        //RITORNA IL TEMPLATE ALLA REGISTRAZIONE
    }


    /**
     * Checks whether the user has input valid credentials
     *
     * @param string $username The user's username
     * @param string $email The user's email
     * @return boolean Whether the sign in details are correct
     */
    private function details_areValid($username, $email)
    {
        try
        {
            if(\Entity\E_User::username_isValid($username) === FALSE)
            {
                throw new Exceptions\InvalidInput(0);
            }
        }
        catch (Exceptions\InvalidInput $ex)
        {
            echo($ex); //LANCIA TEMPLATE PER GESTIRE ERRORE
        }

        try
        {
            if(\Entity\E_User::email_isValid($email) === FALSE)
            {
                throw new Exceptions\InvalidInput(1);
            }
        }
        catch (Exceptions\InvalidInput $ex)
        {
            echo($ex); //LANCIA TEMPLATE PER GESTIRE ERRORE
        }
    }
}