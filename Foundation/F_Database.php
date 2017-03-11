<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foundation; //Both needed to avoid errors with the Autoloader

use Exceptions\queries;
use PDO;
use PDOException;
use PDOStatement;

/**
 * This class enables basic DB operations
 */

class F_Database
{
    /**
     * Tries to connect to the DB
     *
     * @global array $config Needed to set the connection parameters
     * @throws queries In case of connection errors
     * @return PDO The PDO connection to the DB
     */
    protected static function connect()
    {
        try
        {
            global $config;
            $connection = new PDO(
                    'mysql:host='.$config['mysql_host'].'; '
                   .'dbname='.$config['mysql_database'],
                    $config['mysql_user'],
                    $config['mysql_password']
                    );

            //Sostituzione di PDO::ERRMOD_SILENT
//            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT); //Decommenta in Produzione
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Attiva durante lo Sviluppo
            return $connection;
        }
        catch(PDOException $e)
        {
            throw new queries(4, $e);
        }
    }


    /**
     * Saves an object on the DB
     *
     * @param string $query The query used to save a record on the DB
     * @param array $toBind The array of values to bind at the query
     * @return string The last inserted (primary key, auto_incremental) ID. It will show 0 if no ID column exists in the table
     */
    protected static function execute_Query($query, $toBind)
    {
        $pdo = self::connect();
        $pdo_stmt = $pdo->prepare($query);
        self::bind_params($pdo_stmt, $toBind);
        $pdo_stmt->execute();

        $last_id = $pdo->lastInsertId();
        $pdo = NULL; //Closes DB connection
        return $last_id;
    }


    /**
     * Inserts a new record into the DB. Retrieves the last inserted ID
     *
     * @param string $insertInto The table to put the record in
     * @param array $set The values to insert
     * @return int The last inserted ID
     */
    protected static function insert_Query($insertInto, $set)
    {
        $set_values = '';
        foreach(array_keys($set) as $key)
        {
            $set_values .= '`'.$key.'`=?, ';
        }
        $set_values = substr($set_values, 0, -2);

        $query = 'INSERT INTO `'.$insertInto.'` '
                .'SET '.$set_values;

        return self::execute_Query($query, $set);
    }


    /**
     * Fetches the results of the query
     *
     * @param string $query The query to execute
     * @param array $toBind The values to bind to the query
     * @param bool $fetchAll Whether to return one (FALSE) or all (TRUE) the records that match the query
     * @return mixed array An associative array with a numeric keys.
     *                     At each key corresponds another associative array with
     *                     keys named as DB column and their values are the DB records
     *               boolean FALSE in case $fetchAll=FALSE and no records were affected by the query
     */
    protected static function fetch_Result($query, $toBind, $fetchAll = FALSE)
    {
        $pdo = self::connect();
        $pdo_stmt = $pdo->prepare($query);
        self::bind_params($pdo_stmt, $toBind);
        $pdo_stmt->execute();

        $pdo = NULL; //Closes DB connection
        if($fetchAll === TRUE)
        {
            return $pdo_stmt->fetchAll(PDO::FETCH_ASSOC); //Returns a multidimensional array. Different keys mean different records
        }
        return $pdo_stmt->fetch(PDO::FETCH_ASSOC); //Returns an array with a single record
    }


    /**
     * Generates a basic query from the given parameters
     *
     * @param array $select The columns to select. Use a string "*" to select all
     * @param string $from The DB table to search in
     * @param array $where The associative array with the values to search for
     * @return string The complete query
     */
    private static function basic_Query($select, $from, $where)
    {
        $select_columns = $select;
        if($select !== "*")
        {
            $select_columns = '';
            foreach($select as $value)
            {
                $select_columns .= '`'.$value.'`, ';
            }
            $select_columns = substr($select_columns, 0, -2); //Removes the ", " at the end of the string
        }

        $where_clause = '';
        foreach(array_keys($where) as $key)
        {
            $where_clause .= '`'.$key.'`=? AND ';
        }
        $where_clause = substr($where_clause, 0, -5); //Removes the " AND " at the end of the string

        return $query = 'SELECT '.$select_columns.' '
                       .'FROM `'.$from.'` '
                       .'WHERE '.$where_clause;
    }


    /**
     * Returns an array with a single record, matching the query
     *
     * @param array $select The columns to select. Use a string "*" to select all
     * @param string $from The DB table to search in
     * @param array $where The associative array with the values to search for
     * @return mixed An array with the record matching the query
     *               boolean FALSE in case no record matched the query
     */
    protected static function get_One($select, $from, $where)
    {
        $query = self::basic_Query($select, $from, $where);
        return self::fetch_Result($query, $where);
    }


    /**
     * Rethrives all the records that match the query
     *
     * @param array $select The columns to select. Use a string "*" to select all
     * @param string $from The DB table to search in
     * @param array $where The associative array with the values to search for
     * @param int $limit Limits the results to fetch with the query
     * @param int $offset Sets how many records skip before fetching the results
     * @param string $orderBy_column The table column chosen to order the results
     * @param bool $order_DESC Whether to return results in ASCendent or DESCendent style
     * @return array The associative array with all the records that matched the query
     *               An ampty array [] in case no record were affected by the query
     */
    protected static function get_All($select, $from, $where, $limit = 0, $offset = 0, $orderBy_column = '', $order_DESC = FALSE)
    {
        $query = self::basic_Query($select, $from, $where);

        if($orderBy_column !== '')
        {
            $query .= ' ORDER BY `'.$orderBy_column.'`';
            if($order_DESC === TRUE)
            {
                $query .= ' DESC';
            }
        }

        if($limit !== 0)
        {
            $query .=' LIMIT '.$limit
                    .' OFFSET '.$offset;
        }
        $fetchAll = TRUE;
        return self::fetch_Result($query, $where, $fetchAll);
    }


    /**
     * Updates a record from the "users" table. Can only be used in inherited
     * classes which will define the attributes $_table and $_primaryKey.
     * Also it binds parameters to the query
     *
     * @param string $update The DB table into execute the query
     * @param array $set An ARRAY containing new details got from "View"
     * @param array $where The array with information about the column and its value to search for the update
     */
    protected static function update($update, $set, $where)
    {
        $set_values = ''; //String to use for the SET
        foreach(array_keys($set) as $key)
        {
            $set_values .= '`'.$key.'`=?,';
        }

        $where_clause = '';
        foreach(array_keys($where) as $key)
        {
            $where_clause .= '`'.$key.'`=? AND ';
        }
        $set_values = substr($set_values, 0, -1); //Removes the trailing char: ","
        $where_clause = substr($where_clause, 0, -5);
        $query = "UPDATE `$update` "
                ."SET $set_values "
                ."WHERE $where_clause";

        $toBind = array_merge(array_values($set), array_values($where)); //Works
        //even when the same key appears in both arrays
        //F_User::change_Username() is an example

        self::execute_Query($query, $toBind);
    }


    /**
     * Returns the count of matching rows
     *
     * @param string $count The column to count the affected rows from
     * @param string $from The table to count in
     * @param string $where The clauses to be matched for the count
     * @param array $toBind The values to bind at the query
     * @return int The number of affected rows
     */
    protected static function count($count, $from, $where, $toBind = [])
    {
        $query = 'SELECT COUNT(DISTINCT `'.$count.'`) AS total ' //DISTINCT to avoid multiple entries. F_Photo->get_By_Categories is an example
                .'FROM '.$from.' '
                .'WHERE '.$where;

        $total = self::fetch_Result($query, $toBind);
        return intval($total["total"]);
    }


    /**
     * Binds an array of parameters to the query using Question Marks
     *
     * @param PDOStatement $pdo_stmt The PDOStatement object to bind the parameters to
     * @param array $toBind The array of parameters to bind
     * @return PDOStatement The object to execute()
     */
    protected static function bind_params(PDOStatement $pdo_stmt, $toBind)
    {
        if(count($toBind) > 0)
        {
            $i = 1; //Needed to specify which placeholder to bind
            foreach($toBind as $k => $v)
            {
                //$pdo_stmt->bindParam($i, $v); //THIS IS INCORRECT!! IT WILL APPLY THE LAST VALUE TO ALL RECORDS!
                $pdo_stmt->bindParam($i, $toBind[$k]); //Correctly binds parameters
                $i++;
            }
            return $pdo_stmt;
        }
    }
}