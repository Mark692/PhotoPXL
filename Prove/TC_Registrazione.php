<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Prove;

class TC_Registrazione extends \Prove\TFun
{


    public function save_User()
    {
        $username = parent::rnd_str(10)."£";
        $password = parent::rnd_str(10);
        $email = parent::rnd_str(10);

        try
        {
            $e_userSTD = new \Entity\E_User_Standard($username, $password, $email);
            echo("Oggetto creato con successo! Eccolo: ");
            var_dump($e_userSTD);
            echo(nl2br("\r\n"));
        }
        catch (\Exceptions\InvalidInput $ex)
        {
            echo($ex->getMessage()); //LANCIA TEMPLATE PER GESTIRE ERRORE
        }
        //RITORNA IL TEMPLATE ALLA REGISTRAZIONE
    }



}