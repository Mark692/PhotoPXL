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
     * Bans a user
     *
     * @param string $username The user's username
     */
    public static function ban($username)
    {
        $update = "users";
        $set = array("role" => \Utilities\Roles::BANNED);
        $where = array("username" => $username);

        parent::update($update, $set, $where);
    }
}

