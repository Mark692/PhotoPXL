<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foundation;

/**
 * This class allows PRO Users to perform their very functions
 */
class F_User_PRO extends F_User
{

    /**
     * Inserts the user into "users" DB table
     *
     * @param \Entity\E_User_PRO $user The user to insert into the DB
     */
    public static function insert(\Entity\E_User_PRO $user)
    {
        $toBind = array( //Array to pass at the parent::set() function to Bind the correct parameters
            $user->get_Username(),
            $user->get_Password(),
            $user->get_Email(),
            $user->get_Role());

        self::query_insert($toBind);
    }


    /**
     * Saves the array value into the DB
     *
     * @param array $toBind The user details to save in the DB
     */
    protected static function query_insert($toBind)
    {
        $query = 'INSERT INTO `users` SET '
                .'`username`=?, '
                .'`password`=?, '
                .'`email`=?, '
                .'`role`=?';

        parent::set($query, $toBind);
    }
}