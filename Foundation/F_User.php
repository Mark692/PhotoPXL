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
     * Retrieves the user with the given $username
     * 
     * @param string $username The user's username to search
     * @return array The user details
     */
    public static function get_By_Username($username)
    {
        //SELECT username, email, ecc... LA PASS SERVE PER LE UPDATE
        //e SELECT photo FROM profile_pic WHERE user = $username
        $toSearch = array("username" => $username);
        $DB_table = "users";
        $user_details = parent::get($toSearch, $DB_table);
        //Ritorna
    }



    /**
     * Retrieves all the users that match the query
     *
     * @param array $arr_values The values to search with the query
     * @param bool $fetchAll Whether to get 1 (FALSE) or all (TRUE) the records that match the query
     * @param string $orderBy The table column chosen to order the results
     * @param string $orderStyle The ASCendent or DESCendent style to return the results. Allowed values: ASC or DESC
     * @return array All the users that match the query
     */
    public static function get($arr_values, $fetchAll=FALSE, $orderBy='', $orderStyle="ASC")
    {
        $DB_table = "users";
        return parent::get($arr_values, $DB_table, $fetchAll, $orderBy, $orderStyle);
    }


    /**
     * Updates a record from the "users" table
     *
     * @param \Entity\E_User $to_Update The user with new details
     * @param string $old_Username The username saved in the DB. To be specified in case the user changed username
     * @param string $where_column The column to refer to make changes in the table
     */
    public static function update_details(\Entity\E_User $to_Update, $old_Username='')
    {
        $username = $to_Update->get_Username();
        $array_toUpdate = array( //Array to pass at the parent::set() function to Bind the correct parameters
            "username" => $username,
            "password" => $to_Update->get_Password(),
            "email" => $to_Update->get_Email(),
            "role" => $to_Update->get_Role());

        $DB_table = "users";
        $primary_key = "username";
        if($old_Username!=='')          //The "update()" will search for the previous saved username...
        {
            $username = $old_Username;  //...instead of the new (changed) username
        }
        parent::update($array_toUpdate, $DB_table, $primary_key, $username);


        //AGGIUNGI UPDATE PROFILE PIC


    }


    //FUNZIONI PER
    //UP COUNT E LAST UPLAOD


    /**
     * Adds a like to the photo
     *
     * @param int $photo_ID The photo's ID
     * @param string $username The user's username
     */
    public static function add_Like_to($photo_ID, $username)
    {
        $query = 'INSERT INTO `likes` SET '
                .'`user`=?, '
                .'`photo`=?';
        $toBind = array($username, $photo_ID);
        parent::execute_query($query, $toBind);
    }


    /**
     * Retrieves the number of likes from the selected photo
     *
     * @param int $photo_ID The photo's ID
     * @return int The number of likes of the selected photo
     */
    public static function get_Total_Likes($photo_ID)
    {
        $query = "SELECT COUNT(user) "
                ."FROM likes "
                ."WHERE photo=?";

        $pdo = parent::connettiti();
        $pdo_stmt = $pdo->prepare($query);
        $pdo_stmt->bindParam(1, $photo_ID);
        $total_likes = $pdo_stmt->execute();

        $pdo = NULL; //Closes DB connection
        return $total_likes;
    }


    /**
     * Removes the user's like from the selected photo
     *
     * @param string $username The user that wants to remove the like
     * @param int $photo_ID The target photo's ID
     */
    public static function remove_Like($username, $photo_ID)
    {
        $query = "DELETE FROM `likes` "
                ."WHERE (`username`=?) AND (`photo`=?)";

        $toBind = array($username, $photo_ID);
        parent::execute_query($query, $toBind);
    }


}