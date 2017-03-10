<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Control;

use Foundation\F_User;
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
        if ($role == Roles::BANNED or $role == Roles::STANDARD or $role == Roles::PRO
                or $role == Roles::MOD or $role == Roles::ADMIN) {
            if (F_User::is_Available($username)) {
                $userInfo = F_User::get_UserDetails($username);
                /* @var $userInfo \Entity\E_User */
                $userInfo->set_Role($role);
            } else {
                return false;
            }
        } else {
            return false;
        }
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
