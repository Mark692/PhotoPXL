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
     * Changes an user's role
     *
     * @param string $username The user's username
     */
    public static function change_role($username, \Utilities\Roles $new_Role)
    {
        $update = "users";
        $set = array("role" => $new_Role);
        $where = array("username" => $username);

        parent::update($update, $set, $where);
    }
}

