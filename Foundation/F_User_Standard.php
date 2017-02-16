<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foundation;

/**
 * Sets basic info for Standard users
 */
class F_User_Standard extends F_User
{

    /**
     * Upgrades the user's role to PRO
     *
     * @param string $username The user's username
     */
    public static function becomePRO($username)
    {
        $update = "users";
        $set = array("role" => \Utilities\Roles::PRO);
        $where = array("username" => $username);

        parent::update($update, $set, $where);
    }
}
