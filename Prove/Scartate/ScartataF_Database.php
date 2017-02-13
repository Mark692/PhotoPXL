<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Prove\Scartate;

class ScartataF_Database
{


    //comprende controllo errori di PDO con blocco try catch\\
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
        try
        {
            $pdo_stmt->execute();
        }
        catch (PDOException $e)
        {
            throw new \Exceptions\queries(0, $e);
        }

        $last_id = $pdo->lastInsertId();
        $pdo = NULL; //Closes DB connection
        return $last_id;
    }





    /**
     * Updates a record from the "users" table. Can only be used in inherited
     * classes which will define the attributes $_table and $_primaryKey.
     * Also it binds parameters to the query
     *
     * @param array $new_Details An ARRAY containing new details got from "View"
     * @param array $old_Details An ARRAY containing old details. This must be the DB record got from the get_by($q)
     * @param string $_table The DB table into execute the query
     * @param string $where_column The $_table's column used as reference by the WHERE clause
     * @return string The last updated (primary key, auto_incremental) ID. It will show 0 if no ID column exists in the table
     */
    protected static function update($new_Details, $old_Details, $_table, $where_column)
    {
        $set = ''; //String to use for the SET
        $toBind = []; //Array to pass at the self::set() function to Bind the correct parameters
        foreach ($new_Details as $key => $new_value)
        {
            if ($new_value !== $old_Details[$key])
            {
                $set .= '`'.$key.'`=?,';
                array_push($toBind, $new_value);
            }
        }
        if ($set !== '') //$set==='' only if NO changes were made. In this case no update will be done.
        {
            $set = substr($set, 0, -1); //Removes the trailing char: ","
            $where_value = $old_Details[$where_column]; //This will return the value of the column
            $query = "UPDATE `$_table` "
                    ."SET $set "
                    ."WHERE `$where_column`='$where_value'";

            return self::execute_query($query, $toBind);
        }
    }



  //----Scartata perchè non strettamente utile----\\
//\\----Sostituita dall'attuale bind_params()-----//

    /**
     * Binds an array of parameters to the query using PlaceHolders
     *
     * @param \PDOStatement $pdo_stmt The PDOStatement object to bind the parameters to
     * @param array $toBind The array of parameters to bind
     * @return \PDOStatement The object to execute()
     */
    private static function bind_params(\PDOStatement $pdo_stmt, $toBind)
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