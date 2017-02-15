<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Prove\Scartate;

class ScartataF_Photo extends \Foundation\F_Database
{

    /**
     * Instantiates an \Entity\E_User_* user according to its role
     *
     * @param array $details The user details fetched from a query
     * @return \Entity\E_User_* The right user according to its role
     */
    private static function instantiate_EUser($details)
    {
        $username = $details["username"];
        $password = $details["password"];
        $email = $details["email"];
        $up_Count = $details["up_Count"];
        $last_up = $details["last_Up"];
        switch ($details["role"])
        {
            case \Utilities\Roles::STANDARD:
                $user = new \Entity\E_User_Standard($username, $password, $email, $up_Count, $last_up);
                break;
            case \Utilities\Roles::PRO:
                $user = new \Entity\E_User_PRO($username, $password, $email);
                break;
            case \Utilities\Roles::MOD:
                $user = new \Entity\E_User_MOD($username, $password, $email);
                break;
            case \Utilities\Roles::ADMIN:
                $user = new \Entity\E_User_ADMIN($username, $password, $email);
                break;
        }
        return $user;
    }
}