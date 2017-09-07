<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Control;

use Entity\E_User;
use Entity\E_User_Admin;
use Utilities\Roles;

/**
 * This class is used to change roles and ban users.
 *
 * @author Benedetta
 */
class C_Administration {

    /**
     * This method allows ADMIN and MOD to promote or demote other users after checking if the role 
     * is valid and the user exisist in the DB.
     * 
     * @param string $username the user whose role has to be changed.
     * @param enum $role the current role of the user,
     * @return boolean true if it was possible to change the role and save it in the DB.
     */
    public static function changeRole($username, $role) {
        if ($role != Roles::BANNED and $role != Roles::STANDARD and $role != Roles::PRO
                and $role != Roles::MOD and $role != Roles::ADMIN) {
            return false;
        }
        $uRole = E_User::get_DB_Role($_SESSION["username"]);
        if ($uRole != Roles::ADMIN and $uRole != Roles::MOD) {
            return false;
        }
        if (!E_User::is_Available($username)) {
            return false;
        }
        E_User_Admin::change_role($username, \Utilities\Roles::PRO);
        return true;
    }

    /**
     * This method is used to ban users, by recall the changeRole function.
     * 
     * @param string $username the user whose role has to be changed.
     * @return boolean true if it was possible to ban a user.
     */
    public static function ban($username) {
        \Entity\E_User_MOD::ban($username);
    }

}
