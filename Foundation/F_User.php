<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foundation;

/**
 * This class contains basic functions to be inherited and overridden by
 * child classes
 */
class F_User extends \Foundation\F_Database
{

    /**
     * Inserts the user into "users" DB table
     *
     * @param \Entity\E_User_* $e_user The user to insert into the DB
     * @param int $role The user's role. Implemented in each child class
     */
    public static function insert($e_user)
    {
        //PRO, MOD, Admin user setup
        $query = 'INSERT INTO `users` SET '
                .'`username`=?, '
                .'`password`=?, '
                .'`email`=?, '
                .'`role`=?';

        $role = $e_user->get_Role();
        $toBind = array( //Array to pass at the parent::set() function to Bind the correct parameters
            $e_user->get_Username(),
            $e_user->get_Password(),
            $e_user->get_Email(),
            $role);

        //STANDARD user setup
        if($role === \Utilities\Roles::STANDARD)
        {
            $query .= ', '
                .'`last_Upload`=?, '
                .'`up_Count`=?';

        array_push($toBind, $e_user->get_Last_Upload());
        array_push($toBind, $e_user->get_up_Count());
        }

        parent::execute_query($query, $toBind);
    }


    /**
     * Retrives all the users that match the query
     *
     * @param array $arr_values The values to search with the query
     * @param bool $fetchAll Whether to get 1 (FALSE) or all (TRUE) the records that match the query
     * @param string $orderBy The table column chosen to order the results
     * @param string $orderStyle The ASCendent or DESCendent style to return the results. Allowed values: ASC or DESC
     */
    public static function get($arr_values, $fetchAll=FALSE, $orderBy='', $orderStyle="ASC")
    {
        $DB_table = "users";
        return parent::get($arr_values, $DB_table, $fetchAll, $orderBy, $orderStyle);
    }


    /**
     * Updates a record from the "users" table
     *
     * @param array $new_user The ARRAY containing the new user details got from "View"
     * @param array $old_user The ARRAY containing the old user details. The array "old user" is the DB record got from the get_by()
     * @param string $where_column The column to refer to make changes in the table
     */
    public static function update($new_user, $old_user, $where_column="username")
    {
        $DB_table = "users";
        parent::update($new_user, $old_user, $DB_table, $where_column);
    }


    //----AGGIUNTE DA E_User_Basic----\\
    //----CONTROLLA BENE OGNI FUNZIONE E IMPLEMENTALE----\\




    /**
     * Adds a like to the photo
     * @param \Entity\E_Photo $photo_id The liked photo
     */
    public function add_like($photo_id)
    {
        // foundation insert like values ($this->id, $photo_id)
    }


    public function remove_like_from($photo_id)
    {
       // foundation delete from like where $this->id, $photo_id
    }

    public function add_comment($photo_id, $text)
    {
        // foundation insert comments values (photoid, text, $this->id)
    }


    public function remove_comment($comment_id)
    {
        // foundation delete from comments where comment_id
    }

}