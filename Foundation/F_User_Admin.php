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
     * @param int $new_Role The user's new role
     */
    public static function change_Role($username, $new_Role)
    {
        $update = "users";
        $set = array("role" => $new_Role);
        $where = array("username" => $username);

        parent::update($update, $set, $where);
    }
}

