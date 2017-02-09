<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foundation;

/**
 * Sets basic info for MOD users
 */
class F_User_MOD extends F_User_PRO
{

    /**
     * Inserts the user into "users" DB table
     *
     * @param \Entity\F_User_MOD $e_user The user to insert into the DB
     */
    public static function execute_query(\Entity\F_User_MOD $e_user)
    {
        parent::insert($e_user);
    }
}

