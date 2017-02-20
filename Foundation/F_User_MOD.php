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
     * Bans a user if its not an Admin
     *
     * @param string $username The user's username to ban
     */
    public static function ban($username)
    {
        $user_Role = parent::get_Role($username);
        if($user_Role !== \Utilities\Roles::ADMIN)
        {
            $update = "users";
            $set = array("role" => \Utilities\Roles::BANNED);
            $where = array("username" => $username);

            parent::update($update, $set, $where);
        }
    }
}

