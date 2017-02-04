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


    /**
     * Saves an object on the DB
     *
     * @param string $query The query used to save a record on the DB
     * @param array $toBind The array of values to bind at the query
     */
    protected static function insert($query, $toBind)
    {
        $pdo = self::connettiti();
        $pdo_stmt = $pdo->prepare($query);
        $pdo_stmt = self::bind_params($pdo_stmt, $toBind);
        $pdo_stmt->execute();

        $pdo = NULL; //Closes DB connection
    }


    /**
     * Rethrives all the records that match the query
     *
     * @param array $toSearch The associative array with the values to search for
     * @param string $DB_table The DB table to search in
     * @param bool $fetchAll Whether to return one (FALSE) or all (TRUE) the records that match the query
     * @param string $orderBy The table column chosen to order the results
     * @param string $orderStyle The ASCendent or DESCendent style to return the results. Allowed values: ASC or DESC
     * @return array The associative array with all the records that matched the query
     */
    protected static function get($toSearch, $DB_table, $fetchAll=FALSE, $orderBy='', $orderStyle="ASC")
    {
        $where = '';
        foreach ($toSearch as $key => $v)
        {
            $where .= '`'.$key.'`=? AND ';
        }
        $where = substr($where, 0, -5); //Removes the " AND " at the end of the string

        $query = 'SELECT * '
                .'FROM `'.$DB_table.'` '
                .'WHERE '.$where;
        if($orderBy!=='' && ($orderStyle==="ASC" || $orderStyle==="DESC"))
        {
            $query .= ' ORDER BY '.$orderBy.' '.$orderStyle;
        }
        
        $pdo = self::connettiti();
        $pdo_stmt = $pdo->prepare($query);
        $pdo_stmt = self::bind_params($pdo_stmt, $toSearch);
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
     * classes which will define the attributes $_table and $_primaryKey.
     * Also it binds parameters to the query
     *
     * @param array $new_Details An ARRAY containing new details got from "View"
     * @param array $old_Details An ARRAY containing old details. This must be the DB record got from the get_by($q, FALSE).
     * @param string $_table The DB table into execute the query
     * @param string $_primaryKey The $_table's primary key
     */
    protected function update($new_Details, $old_Details, $_table, $_primaryKey)
    {
        $set = ''; //String to use for the SET
        $toBind = []; //Array to pass at the self::set() function to Bind the correct parameters
        foreach($new_Details as $key => $new_value)
        {
            if($new_value !== $old_Details[$key])
            {
                $set .= '`'.$key.'`=?,';
                array_push($toBind, $new_value);
            }
        }
        if($set!=='') //$set==='' only if NO changes were made. In this case no update will be done.
        {
            $set = substr($set, 0, -1); //Removes the trailing char: ","
            $where = $old_Details['username'];
            $query = "UPDATE `$_table` "
                   . "SET $set "
                   . "WHERE `$_primaryKey`='$where'";

            self::insert($query, $toBind);
        }
    }


    /**
        * Binds an array of parameters to the query using Question Marks
     *
     * @param \PDOStatement $pdo_stmt The PDOStatement object to bind the parameters to
     * @param array $toBind The array of parameters to bind
     * @return \PDOStatement The object to execute()
     */
    private static function bind_params(\PDOStatement $pdo_stmt, $toBind)
    {
        $i=1; //Needed to specify which placeholder to bind
        foreach($toBind as $k => $v)
        {
            //$pdo_stmt->bindParam($i, $v); //THIS IS INCORRECT!! IT WILL APPLY THE LAST VALUE TO ALL RECORDS!
            $pdo_stmt->bindParam($i, $toBind[$k]); //Correctly binds parameters
            $i++;
        }
        return $pdo_stmt;
    }


    /**
     * Binds an array of parameters to the query using PlaceHolders
     *
     * @param \PDOStatement $pdo_stmt The PDOStatement object to bind the parameters to
     * @param array $toBind The array of parameters to bind
     * @return \PDOStatement The object to execute()
     */
    private static function bind_params_PH(\PDOStatement $pdo_stmt, $toBind)
    {
        foreach($toBind as $k => $v)
        {
            $placeholder = ":$k";
            //$pdo_stmt->bindParam($i, $v); //THIS IS INCORRECT!! IT WILL APPLY THE LAST VALUE TO ALL RECORDS!
            $pdo_stmt->bindParam($placeholder, $toBind[$k]); //Correctly binds parameters
        }
        return $pdo_stmt;
    }
}