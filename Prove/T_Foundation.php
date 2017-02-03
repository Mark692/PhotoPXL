<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Prove;

use \PDO,
    \PDOException; //Both needed to avoid errors with the Autoloader

class T_Foundation
{

    public static function db_fetches()
    {
        $where_column = "email";
        $where_value = "PRO@mail.com";

        $query = 'SELECT * '
                .'FROM `users` '
                .'WHERE `'.$where_column.'` = \''.$where_value.'\'';

        $pdo = \Foundation\F_Database::connettiti(); //ATTENZIONE SE RIUSI QUESTA FUNZIONE!
        //DEVI RIMETTERE \Foundation\F_Database::connettiti() A PUBLIC!!!!!

        $pdo_stmt = $pdo->prepare($query);
        $pdo_stmt->execute();

        //Questi sono gli unici giusti
        $fetch = array(
            PDO::FETCH_ASSOC,
            PDO::FETCH_NAMED);

        $fetchAll = array(
            PDO::FETCH_ASSOC,
            PDO::FETCH_NAMED);


        echo("PDO->fetch()".nl2br("\r\n").nl2br("\r\n"));

        foreach($fetch as $k => $v)
        {
            echo("Chiave $k".nl2br("\r\n"));
            print_r($pdo_stmt->fetch($v));
            echo(nl2br("\r\n").nl2br("\r\n"));
        }

        echo("_______________________________________________________________________".nl2br("\r\n").nl2br("\r\n"));
        echo("PDO->fetchALL()".nl2br("\r\n").nl2br("\r\n"));

        foreach($fetchAll as $k => $v)
        {
            echo("Chiave $k".nl2br("\r\n"));
            print_r($pdo_stmt->fetchAll($v));
            echo(nl2br("\r\n").nl2br("\r\n"));
        }

        $pdo = NULL; //Closes DB connection
    }
}