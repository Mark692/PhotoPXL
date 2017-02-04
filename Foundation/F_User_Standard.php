<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foundation;

/**
 * This class allows Standard Users to perform their very functions
 */
class F_User_Standard extends F_User
{

    /**
     * Inserts the user into "users" DB table
     *
     * @param \Entity\E_User_Standard $user The user to insert into the DB
     */
    public static function insert(\Entity\E_User_Standard $user)
    {
        $query = 'INSERT INTO users SET '
                .'`username`=?, '
                .'`password`=?, '
                .'`email`=?, '
                .'`role`=?, '
                .'`last_Upload`=?, '
                .'`up_Count`=?';

        $toBind = array( //Array to pass at the parent::set() function to Bind the correct parameters
            $user->get_Username(),
            $user->get_Password(),
            $user->get_Email(),
            $user->get_Role(),
            $user->get_Last_Upload(),
            $user->get_up_Count());

        parent::set($query, $toBind);
    }



}