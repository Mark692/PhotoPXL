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
class F_User_Admin extends F_User_MOD
{

    /**
     * Inserts the user into "users" DB table
     *
     * @param \Entity\E_User_Admin $user The user to insert into the DB
     */
    public static function insert(\Entity\E_User_Admin $user)
    {
        $toBind = array( //Array to pass at the parent::set() function to Bind the correct parameters
            $user->get_Username(),
            $user->get_Password(),
            $user->get_Email(),
            $user->get_Role());

        parent::query_insert($toBind);
    }


    /**
     * Changes an \Entity\E_User_*'s role
     *
     * @param \Entity\E_User_* object $e_user The Entity user to whom change the role
     * @param int $new_role The new user role
     */
    public static function change_role($e_user, $new_role)
    {
        $user_details = array(
            "username" => $e_user->get_Username(),
            "role"     => $e_user->get_Role()
            );

        $new_user = array("role" => $new_role);
        parent::update($new_user, $user_details);
    }
}

