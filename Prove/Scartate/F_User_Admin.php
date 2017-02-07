<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


namespace Prove\Scartate;

class ScartataF_Database
{


//----SCARTATA PERCHE' VA IMPLEMENTATA IN ENTITY----\\
//----Sostituita dalla Entity\E_User_Admin->change_role()----\\
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