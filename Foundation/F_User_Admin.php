<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foundation;

use Exceptions\queries;
use ReflectionClass;

/**
 * Sets basic functions for Admin users
 */
class F_User_Admin extends F_User_MOD
{
    /**
     * Changes an user's role
     *
     * @param string $username The user's username
     * @param int $new_Role The user's new role
     * @throws queries In case of connection errors
     * @return boolean Whether the action was successful or not
     */
    public static function change_Role($username, $new_Role)
    {
        $roles = new ReflectionClass('\Utilities\Roles');
        $allowed = $roles->getConstants();

        if(in_array($new_Role, $allowed, TRUE))
        {
            $update = "users";
            $set = array("role" => $new_Role);
            $where = array("username" => $username);

            parent::update($update, $set, $where);
            return TRUE;
        }
        return FALSE;
    }


}