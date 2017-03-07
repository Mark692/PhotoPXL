<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace P;

class user extends \P\prova
{
    private $user;

    /*
     * Crea un utente standard casuale
     */
    public function __construct()
    {
        $username = parent::rnd_str();
        $password = parent::rnd_str(15);
        $email = "std@ita.it";

        $this->username = $username;
        $this->user = new \Entity\E_User($username, $password, $email);
    }


    /*
     * Istanzia un oggetto E_User_* in base al ruolo.
     */
    public function GET_USERDETAILS()
    {
        $nomi = array("GGWGsxkMDs", "dAquwO1kDF", "AllUser", "NonEsisteNelDB");
        foreach($nomi as $n)
        {
            echo("Nome: $n");
            echo(nl2br("\r\n"));
            echo("Dettagli: ");
            var_dump(\Foundation\F_User::get_UserDetails($n));
            echo(nl2br("\r\n"));
            echo(nl2br("\r\n"));
            echo(nl2br("\r\n"));
        }
    }


    /*
     * Controlla se l'username è disponibile, restituisce un BOOLEANO.
     * Ricorda che è case sensitive quindi prova più username simili!!
     */
    public function IS_AVAILABLE()
    {
        $nomi = array("AllUser", "allusers", "NonEsiste", "DisponibileEeEe", "ChissàSeQuestoVaBene", "dAquwO1kDF");
        foreach($nomi as $n)
        {
            echo("Nome: $n");
            echo(nl2br("\r\n"));
            echo("E' disponibile: ");
            var_dump(\Foundation\F_User::is_Available($n));
            echo(nl2br("\r\n"));
            echo(nl2br("\r\n"));
            echo(nl2br("\r\n"));
        }
    }


    /*
     * Prende solo password e ruolo dell'utente. Se l'utente non viene trovato,
     * DEVE tornare boolean FALSE
     */
    public function GET_LOGININFO()
    {
        $nomi = array("AllUser", "NonEsiste", "oCOXiFp17P", "ChissàSeQuestoVaBene", "dAquwO1kDF");
        foreach($nomi as $n)
        {
            echo("Nome: $n");
            echo(nl2br("\r\n"));
            echo("Login Info: ");
            var_dump(\Foundation\F_User::get_LoginInfo($n));
            echo(nl2br("\r\n"));
            echo(nl2br("\r\n"));
            echo(nl2br("\r\n"));
        }
    }


    /*
     * Prende il ruolo dell'utente selezionato. Se l'utente non esiste ritorna
     * un booleano FALSE
     */
    public function GET_ROLE()
    {
        $nomi = array("AllUser", "NonEsiste", "4NJTwjzfBC", "ChissàSeQuestoVaBene", "dAquwO1kDF");
        foreach($nomi as $n)
        {
            echo("Nome: $n");
            echo(nl2br("\r\n"));
            echo("Ruolo: ");
            var_dump(\Foundation\F_User::get_Role($n));
            echo(nl2br("\r\n"));
            echo(nl2br("\r\n"));
            echo(nl2br("\r\n"));
        }
    }


    /*
     * Prende il ruolo dell'utente selezionato.
     * Divide il totale di record trovati in pagine con limite impostato in USER_PER_PAGE
     * Se l'utente non esiste ritorna un booleano FALSE
     */
    public function GET_BY_ROLE()
    {
        $ruolo = array(
            "Bannato" => 0,
            "STD" => 1,
            "PRO" => 2,
            "MOD" => 3,
            "ADMIN" => 4,
            "Non Usato" => 5);
        $pageToView = 1;
        foreach($ruolo as $k => $r)
        {
            echo("Ruolo: $k");
            echo(nl2br("\r\n"));
            echo("Utenti trovati: ");
            var_dump(\Foundation\F_User::get_By_Role($r, $pageToView));
            echo(nl2br("\r\n"));
            echo(nl2br("\r\n"));
            echo(nl2br("\r\n"));
        }
    }


    public function CHANGE_DETAILS($change_Function)
    {
        $username2 = "CambiatoUsername";
        $password = "tanto viene hashata...";
        $email = "update@pro.va";
        $changed = new \Entity\E_User($username2, $password, $email);
        $changed->set_Role(\Utilities\Roles::ADMIN);

        $old = "we";

        if($change_Function == 1)
        {
            echo("1. Change_Username:");
            echo(nl2br("\r\n"));
            echo("Vecchio: ".$old);
            echo(nl2br("\r\n"));
            echo("Nuovo: ".$username2);
            \Foundation\F_User::change_Username($changed, $old);
        }
        elseif($change_Function == 2)
        {
            echo("1. Change_Password:");
            echo(nl2br("\r\n"));
            echo("Nuova password: ".$password);
            echo(nl2br("\r\n"));
            echo("Hashata: ".hash("sha512", $password));
            echo(nl2br("\r\n"));
            echo("Username: ".$username2);
            \Foundation\F_User::change_Password($changed);
        }
        elseif($change_Function == 3)
        {
            echo("1. Change_Email:");
            echo(nl2br("\r\n"));
            echo("Nuova email: ".$email);
            echo(nl2br("\r\n"));
            echo("Username: ".$username2);
            \Foundation\F_User::change_Email($changed);
        }

    }

































    }


























