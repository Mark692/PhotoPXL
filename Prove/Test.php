<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Prove;

/**
 * Questa classe testa i vari oggetti Entity ed i metodi di classe. Viene fornito
 * output per ogni metodo testato
 */
class Test extends \Prove\Fun
{

    /**
     * Genera un \Entity\E_User casuale
     * @return array of E_User object
     */
    public function TE_User()
    {
        //Creazione di un oggetto E_User con dati casuali
        $rn_user = parent::rnd_str(7);
        $rn_pass = parent::rnd_str(10);
        $rn_email = parent::rnd_str(rand(5, 10))."@".parent::rnd_str(rand(2, 5)).".".parent::rnd_str(rand(2, 3));
        $rn_role = rand(0, 4);
        $rn_uploads = rand(0, 14);

        $e_user = new \Entity\E_User($rn_user, $rn_pass, $rn_email, $rn_role, $rn_uploads);



        //Stampa l'oggetto
        echo("Oggetto utente con costruttore ridotto: niente timestamp.".nl2br("\r\n"));
        parent::ogg2arr($e_user);
//        $ttt = time() - 1400000000;
//        $e_user2 = new \Entity\E_User($rn_user, $rn_pass, $rn_email, $rn_role, $rn_uploads, $ttt);
//        echo(nl2br("\r\n")."Oggetto utente con costruttore completo: timestamp - 1400000000.".nl2br("\r\n"));
//        parent::ogg2arr($e_user2);


        //Testa i metodi dell'oggetto
        $e_user->set_username("Nuovo Username");
        echo("Set e Get di un nuovo Username: ".$e_user->get_username().nl2br("\r\n"));
        $e_user->set_password("Nuova Password");
        echo("Set e Get di una nuova Password: ".$e_user->get_password().nl2br("\r\n"));
        $e_user->set_mail("(hio[{1òlà|ì13è7*.éù@0'ì\"£$%&/()=?-.,;");
        echo("Set e Get di una email in forma (hio[{1òlà|ì13è7*.éù@0'ì\"£$%&/()=?-.,; : ".$e_user->get_mail().nl2br("\r\n"));

        for($i=-2; $i<7; $i++)
        { //CONTINUA DA QUI - CAMBIA....
            $e_user->set_username("Nuovo Username");
            echo("Set e Get di un nuovo Username: ".$e_user->get_username().nl2br("\r\n"));
        }
        $e_user->set_username("Nuovo Username");
        echo("Set e Get di un nuovo Username: ".$e_user->get_username().nl2br("\r\n"));

    }


    /**
     * Genera un oggetto \Entity\E_Photo casuale
     * @return E_Photo object
     */
    public function TE_Photo()
    {


    }













}