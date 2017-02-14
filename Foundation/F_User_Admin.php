<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foundation;

/**
 * Sets basic info for Admin users
 */
class F_User_Admin extends F_User_MOD
{

    /**
     * Inserts the user into "users" DB table
     *
     * @param \Entity\F_User_Admin $e_user The user to insert into the DB
     */
    public static function insert(\Entity\F_User_Admin $e_user)
    {
        parent::insert($e_user);
    }
}