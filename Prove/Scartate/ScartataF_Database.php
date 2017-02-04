<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Prove\Scartate;

class ScartataF_Database
{

//----Scartata perchè non funziona con i Prepared Statements----\\
//    \\----Sostituita con l'attuale funzione get()----//

    /**
     * Rethrives all the records that match the query
     *
     * @param array $toSearch The associative array with the values to search for
     * @param string $DB_table The DB table to search in
     * @param bool $fetchAll Whether to return one (FALSE) or all (TRUE) the records that match the query
     * @return array The associative array with all the records that matched the query
     */
    protected static function get($toSearch, $DB_table, $fetchAll=FALSE)
    {
        $where = '';
        foreach ($toSearch as $key => $v)
        {
            $where .= '`'.$key.'`=?,';
        }
        $where = substr($where, 0, -1); //Removes the trailing "," from the string $where

        $query = 'SELECT * '
                .'FROM `'.$DB_table.'` '
                .'WHERE '.$where;

        echo($query);

        $pdo = self::connettiti();
        $pdo_stmt = $pdo->prepare($query);
        $pdo_stmt = self::bind_params($pdo_stmt, $toSearch); //FALLISCE A BINDARE I PARAMETRI
        $pdo_stmt->execute();

        $pdo = NULL; //Closes DB connection
        if($fetchAll===TRUE)
        {
            return $pdo_stmt->fetchAll(PDO::FETCH_ASSOC); //Returns a multidimensional array. Different keys mean different records
        }
        return $pdo_stmt->fetch(PDO::FETCH_ASSOC); //Returns an array with a single record
        //RITORNA SEMPRE NULL
    }







//----Scartata perchè non provvista di Prepared Statements----\\
//    \\----Sostituita con l'attuale funzione update()----//

    /**
     * Updates a record from the "users" table. Can only be used in inherited
     * classes which will define the attributes $_table and $_primaryKey
     *
     * @param array $new_Details An ARRAY containing new details got from "View"
     * @param array $old_Details An ARRAY containing old details. This must be the DB record got from the get_by($q, FALSE).
     * @param string $_table The DB table into execute the query
     * @param string $_primaryKey The $_table's primary key
     */
    protected function update($new_Details, $old_Details, $_table, $_primaryKey)
    {
        $set = '';
        foreach($old_Details as $key => $old_value)
        {
            if($old_value !== $new_Details[$key])
            {
                $set .= '`'.$key.'`=\''.$new_Details[$key].'\',';
            }
        }
        if($set!=='') //$set==='' only if NO changes were made. In this case no update will be done.
        {
            $set = substr($set, 0, -1); //Removes the trailing char: ","
            $where = $old_Details['username'];
            $query = "UPDATE `$_table` "
                   . "SET $set "
                   . "WHERE `$_primaryKey`='$where'";
            self::set($query);
        }
    }
}