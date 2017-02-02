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
    public static function insert_this(\Entity\E_User_PRO $user)
    {
        $values['username'] = $user->get_Username();
        $values['password'] = $user->get_Password();
        $values['email'] = $user->get_Email();
        $values['role'] = $user->get_Role();

        self::query_insert($values);
    }


    /**
     * Saves the array value into the DB
     *
     * @param array $values The user details to save in the DB
     */
    protected static function query_insert($values)
    {
        $query = 'INSERT INTO users SET '
                .'username=\''.$values['username'].'\', '
                .'password=\''.$values['password'].'\', '
                .'email=\''.$values['email'].'\', '
                .'role=\''.$values['role'].'\'';

        parent::set($query);
    }
}