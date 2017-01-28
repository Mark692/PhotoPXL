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
//    public function __construct()
//    {
//        parent::$tabella = 'users';
//        parent::$chiave_Primaria = 'username';
//    }


    /**
     * Retrives all the users that match the query
     * @param type $value searched with the query
     * @param bool $orderBy to select the preferred order to display results
     * @param string $column the column to search
     */
    public static function get_record($value, $orderBy, $column = "username")
    {
        $query = "SELECT * "
                ."FROM users "
                ."WHERE ".$column." = '".$value."'";
        if (!$orderBy)
        {
            $query = $query."ORDER BY DESC";
        }
        $record = parent::get($query);
        return $record;
    }


    /**
     * Saves the user into the DB
     * @param \Entity\E_User_Standard $user
     */
    public static function set_user(\Entity\E_User_Standard $user)
    {
        $query = "INSERT INTO users SET ";
        parent::set($user, $query);
    }

}