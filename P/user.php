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
        $nomi = array("AllUser", "allusers", "NonEsiste", "DisponibileEeEe", "ChissàSeQuestoVaBene", "dAquwO1kDFW");
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


    /*
     * Prende il ruolo dell'utente selezionato. Se l'utente non esiste ritorna
     * un booleano FALSE
     */
    public function GET_ROLE()
    {
        $nomi = array("AllUser", "NonEsiste", "4NJTwjzfBC", "ChissàSeQuestoVaBene", "dAquwO1kDFW");
        foreach($nomi as $n)
        {
            echo("Nome: $n");
            echo(nl2br("\r\n"));
            echo("Ruolo: ");
            var_dump(\Foundation\F_User::get_Role($n));
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
        }
    }


    /*
     * Aggiorna un utente nella tabella "users"
     */
    public function UPDATE_PROFILE()
    {
        $old = array("AllUser", "YkgoustH6r", "iZnMBrGUFz", "dAquwO1kDFW", "QuestoNonEsiste");
        foreach($old as $n)
        {
            $username = parent::rnd_str(15);
            $password = parent::rnd_str(15);
            $email = "MOD@pro.va";
            echo("Vecchio Username: $n");
            echo(nl2br("\r\n"));
            echo("Nuovo Username: $username");
            echo(nl2br("\r\n"));
            echo("Nuovo oggetto: ");
            $user = new \Entity\E_User_MOD($username, $password, $email);
            echo(nl2br("\r\n"));
            echo("Esito dell'update: ");
            var_dump(\Foundation\F_User::update_Profile($user, $n));
            echo(nl2br("\r\n"));
        }

    }



























}