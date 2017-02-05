<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Prove\Scartate;

class ScartataF_Database
{

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