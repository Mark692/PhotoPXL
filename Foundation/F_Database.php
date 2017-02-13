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
                    'mysql:host='.$config['mysql_host'].'; dbname='.$config['mysql_database'], $config['mysql_user'], $config['mysql_password']);

            //Sostituzione di PDO::ERRMOD_SILENT
//            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT); //Decommenta in Produzione
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
     * @return string The last inserted (primary key, auto_incremental) ID. It will show 0 if no ID column exists in the table
     */
    protected static function execute_query($query, $toBind)
    {
        $pdo = self::connettiti();
        $pdo_stmt = $pdo->prepare($query);
        $pdo_stmt = self::bind_params($pdo_stmt, $toBind);
        $pdo_stmt->execute();

        $last_id = $pdo->lastInsertId();
        $pdo = NULL; //Closes DB connection
        return $last_id;
    }


    /**
     * Rethrives all the records that match the query
     *
     * @param array $where_toSearch The associative array with the values to search for
     * @param string $from The DB table to search in
     * @param string $select The string containing a selection of columns to retrieve with the query
     * @param bool $fetchAll Whether to return one (FALSE) or all (TRUE) the records that match the query
     * @param string $orderBy_column The table column chosen to order the results
     * @param bool $order_DESC Whether to return results in ASCendent or DESCendent style
     * @return array The associative array with all the records that matched the query
     */
    protected static function get($where_toSearch, $from, $select='*', $fetchAll=FALSE, $orderBy_column='', $order_DESC=FALSE)
    {
        $where = '';
        foreach ($where_toSearch as $key => $v) //Need the key only here!
        {
            $where .= '`'.$key.'`=? AND ';
        }
        $where = substr($where, 0, -5); //Removes the " AND " at the end of the string

        $query = 'SELECT `'.$select.'` '
                .'FROM `'.$from.'` '
                .'WHERE '.$where;
        if ($fetchAll===TRUE && $orderBy_column!=='' )
        {
            $query .= ' ORDER BY `'.$orderBy_column.'`';
            if ($order_DESC===TRUE)
            {
                $query .= ' DESC';
            }
        }

        $pdo = self::connettiti();
        $pdo_stmt = $pdo->prepare($query);
        $pdo_stmt = self::bind_params($pdo_stmt, $where_toSearch); //Need the values here!
        $pdo_stmt->execute();

        $pdo = NULL; //Closes DB connection
        if ($fetchAll === TRUE)
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
     * @param string $update The DB table into execute the query
     * @param array $set_newDetails An ARRAY containing new details got from "View"
     * @param array $where The array with information about the column and its value to search for the update
     */
    protected static function update($update, $set_newDetails, $where)
    {
        $set = ''; //String to use for the SET
        foreach ($set_newDetails as $key => $new_value)
        {
            $set .= '`'.$key.'`=?,';
        }
        $set = substr($set, 0, -1); //Removes the trailing char: ","
        $query = "UPDATE `$update` "
                ."SET $set "
                ."WHERE `$where[0]`='$where[1]'";

        self::execute_query($query, $set_newDetails);
    }


    /**
     * Binds an array of parameters to the query using Question Marks
     *
     * @param \PDOStatement $pdo_stmt The PDOStatement object to bind the parameters to
     * @param array $toBind The array of parameters to bind
     * @return \PDOStatement The object to execute()
     */
    public static function bind_params(\PDOStatement $pdo_stmt, $toBind)
    {
        if(count($toBind)>0)
        {
            $i = 1; //Needed to specify which placeholder to bind
            foreach ($toBind as $k => $v)
            {
                //$pdo_stmt->bindParam($i, $v); //THIS IS INCORRECT!! IT WILL APPLY THE LAST VALUE TO ALL RECORDS!
                $pdo_stmt->bindParam($i, $toBind[$k]); //Correctly binds parameters
                $i++;
            }
            return $pdo_stmt;
        }
        throw new \Exceptions\queries(1, "Nessun valore trovato per soddisfare la richiesta");
    }
}