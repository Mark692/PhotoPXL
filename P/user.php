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
     * Prende tutte le colonne dalla tabella "users"
     */
    public function GET_USERDETAILS()
    {
        $nomi = array("GGWGsxkMDs", "dAquwO1kDFW", "AllUser", "NonEsisteNelDB");
        foreach($nomi as $n)
        {
            echo("Nome: $n");
            echo(nl2br("\r\n"));
            echo("Dettagli: ");
            var_dump(\Foundation\F_User::get_UserDetails($n));
            echo(nl2br("\r\n"));
        }
    }


    /*
     * Controlla se l'username è disponibile, restituisce un BOOLEANO.
     * Ricorda che è case sensitive quindi prova più username simili!!
     */
    public function IS_AVAILABLE()
    {
        $nomi = array("AllUser", "allusers", "NonEsiste", "DisponibileEeEe", "ChissàSeQuestoVaBene", "dAquwO1kDFW");
        foreach($nomi as $n)
        {
            echo("Nome: $n");
            echo(nl2br("\r\n"));
            echo("E' disponibile: ");
            var_dump(\Foundation\F_User::is_Available($n));
            echo(nl2br("\r\n"));
        }
    }


    /*
     * Prende solo password e ruolo dell'utente. Se l'utente non viene trovato,
     * DEVE tornare boolean FALSE
     */
    public function GET_LOGININFO()
    {
        $nomi = array("AllUser", "NonEsiste", "oCOXiFp17P", "ChissàSeQuestoVaBene", "dAquwO1kDFW");
        foreach($nomi as $n)
        {
            echo("Nome: $n");
            echo(nl2br("\r\n"));
            echo("Login Info: ");
            var_dump(\Foundation\F_User::get_LoginInfo($n));
            echo(nl2br("\r\n"));
        }

    }
}