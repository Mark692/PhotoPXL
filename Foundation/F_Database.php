<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foundation;

use \PDO,
    \PDOException; //Both needed to avoid errors with the Autoloader

/**
 * This class enables basic DB operations
 */
class F_Database
{

    /**
     * Tries to connect to the DB
     *
     * @global array $config Needed to set the connection parameters
     * @throws PDOException In case of connection errors
     * @return PDO $connection The PDO connection to the DB
     */
    protected static function connettiti()
    {
        try
        {
            global $config;
            $connection = new PDO(
                    'mysql:host='.$config['mysql_host'].'; dbname='.$config['mysql_database'],
                    $config['mysql_user'],
                    $config['mysql_password']);

            //Sostituzione di PDO::ERRMOD_SILENT
            //$connessione->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMOD_SILENT) //Decommenta in Produzione
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Attiva durante lo Sviluppo
            return $connection;
        }
        catch (PDOException $e)
        {
            echo "Impossibile connettersi al database. Errore: ".$e;
        }
    }


    /*
     * Saves an object on the DB
     *
     * @param string $query The query used to save a record on the DB
     */
    protected static function set($query)
    {
        $pdo = self::connettiti();
        $pdo_stmt = $pdo->prepare($query);
        $pdo_stmt->execute();

        $pdo = NULL; //Closes DB connection
    }


    /**
     * Executes and rethrives a record from the DB
     *
     * @param string $query The query to execute
     * @param bool $fetchAll Whether to return ALL record or only one
     * @return array The result array of the query
     */
    protected static function get($query, $fetchAll=FALSE)
    {
        $pdo = self::connettiti();
        $pdo_stmt = $pdo->prepare($query);
        $pdo_stmt->execute();

        $pdo = NULL; //Closes DB connection
        if($fetchAll===TRUE)
        {
            return $pdo_stmt->fetchAll(PDO::FETCH_ASSOC); //Returns a multidimensional array. Different keys mean different records
        }
        return $pdo_stmt->fetch(PDO::FETCH_ASSOC); //Returns an array with a single record
    }


    /**
     * Updates a record from the "users" table. Can only be used in inherited
     * classes which will define the attributes $_table and $_primaryKey
     *
     * @param array $new_Details An ARRAY containing new details got from "View"
     * @param array $old_Details An ARRAY containing old details. This is the DB record got from the get_by().
     *        Will be used as $old_Details[0] meaning the first (and only) record got from the get_by
     * @param string $_table The DB table into execute the query
     * @param string $_primaryKey The $_table's primary key
     */
    protected function update($new_Details, $old_Details, $_table, $_primaryKey)
    {
        $set = '';
        foreach($old_Details as $key => $value)
        {
            if($old_Details[$key] !== $new_Details[$key])
            {
                $set .= '`'.$key.'`=\''.$new_Details[$key].'\',';
            }
        }
        $set = substr($set, 0, -1); //Removes the trailing char: ","
        $where = $old_Details['username'];
        $query = "UPDATE `$_table` "
               . "SET $set "
               . "WHERE `$_primaryKey`='$where'";

        self::set($query);
    }
}