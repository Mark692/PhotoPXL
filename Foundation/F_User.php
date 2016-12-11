<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foundation;

//use \PDO; //Per evitare errori con l'autoloader

class F_User extends \Foundation\F_Database
{


    /*
     * Imposta i parametri base per la connessione a DB come il nome della tabella
     * sulla quale operare ed il nome della chiave primaria.
     */
    public function __construct()
    {
        parent::$tabella = "users";
        parent::$chiave_Primaria = "username";
    }





}