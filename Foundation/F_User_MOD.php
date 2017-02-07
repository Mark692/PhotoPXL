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
        $toBind = array( //Array to pass at the parent::set() function to Bind the correct parameters
            $user->get_Username(),
            $user->get_Password(),
            $user->get_Email(),
            $user->get_Role());

        parent::query_insert($toBind);
    }


    /**
     * Bans a user changing its role to 0. Only applies if the user is not an ADMIN
     *
     * @param object $e_user An Entity\E_User_* object.
     * This user will be banned if not an ADMIN
     */
    public static function ban_E_User($e_user)
    {
        $role = $e_user->get_Role();
        if($role !== \Utilities\Roles::ADMIN)
        {
            $user_details = array(
                "username" => $e_user->get_Username(),
                "role"     => $role
                );

            $banned_user = array(
                "role" => \Utilities\Roles::BANNED
                //May add here more options/restrictions for the banned users
                );

            parent::update($banned_user, $user_details);
        }
    }
}