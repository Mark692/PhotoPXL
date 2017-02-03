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
class F_User_MOD extends F_User_PRO
{

    /**
     * Inserts the user into "users" DB table
     *
     * @param \Entity\E_User_MOD $user The user to insert into the DB
     */
    public static function insert(\Entity\E_User_MOD $user)
    {
        $values['username'] = $user->get_Username();
        $values['password'] = $user->get_Password();
        $values['email'] = $user->get_Email();
        $values['role'] = $user->get_Role();

        parent::query_insert($values);
    }
}