<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foundation;

/**
 * Sets basic info for Standard users
 */
class F_User_Standard extends F_User
{

    /**
     * Inserts the user into "users" DB table
     *
     * @param \Entity\F_User_Standard $e_user The user to insert into the DB
     */
    public static function insert(\Entity\F_User_Standard $e_user)
    {
        $query = 'INSERT INTO `users` SET '
                .'`username`=?, '
                .'`password`=?, '
                .'`email`=?, '
                .'`role`=?, '
                .'`last_Upload`=?, '
                .'`up_Count`=?';

        $toBind = array( //Array to pass at the parent::set() function to Bind the correct parameters
            $e_user->get_Username(),
            $e_user->get_Password(),
            $e_user->get_Email(),
            $e_user->get_Role(),
            $e_user->get_Last_Upload(),
            $e_user->get_up_Count());

        parent::execute_query($query, $toBind);
    }
}