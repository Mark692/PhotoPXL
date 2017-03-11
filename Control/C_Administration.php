<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Control;

use Entity\E_User;
use Utilities\Roles;

/**
 * Description of C_Administration
 *
 * @author Benedetta
 */
class C_Administration {

    /**
     * 
     * @param type $username
     * @param type $role
     * @return boolean
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
        $userInfo = E_User::get_UserDetails($username);
        /* @var $userInfo \Entity\E_User */
        $userInfo->set_Role($role);
        return true;
    }

    /**
     * 
     * @param type $username
     * @return type
     */
    public static function ban($username) {
        return self::changeRole($username, Roles::BANNED);
    }

}
