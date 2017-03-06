<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foundation;

use Entity\E_User_Standard;
use Foundation\F_User;
use Utilities\Roles;

/**
 * Sets basic info for Standard users
 */
class F_User_Standard extends F_User
{

    /**
     * Inserts the user into "users" DB table
     *
     * @param E_User_Standard $STD_user The new user to insert into the DB
     */
    public static function insert(E_User_Standard $STD_user)
    {
        $insertInto = "users";
        $username = $STD_user->get_Username();

        $set = array(
            "username" => $username,
            "password" => $STD_user->get_Password(),
            "email" => $STD_user->get_Email(),
            "role" => $STD_user->get_Role(),
            "last_Upload" => $STD_user->get_Last_Upload(),
            "up_Count" => $STD_user->get_up_Count()
                );

        parent::insert_Query($insertInto, $set);

        //Inserts a default Profile Pic
        parent::insert_DefaultProPic($username);
    }


    /**
     * Updates the "last_Upload" and the "up_Count" of the user
     *
     * @param E_User_Standard $STD_user The user uploading a photo
     */
    public static function update_Counters(E_User_Standard $STD_user)
    {
        $update = "users";
        $set = array(
            "last_Upload" => $STD_user->get_Last_Upload(),
            "up_Count" => $STD_user->get_up_Count()
            );
        $where = array("username" => $STD_user->get_Username());

        parent::update($update, $set, $where);
    }


    /**
     * Upgrades the user's role to PRO
     *
     * @param string $username The user's username
     */
    public static function becomePRO($username)
    {
        $update = "users";
        $set = array("role" => Roles::PRO);
        $where = array("username" => $username);

        parent::update($update, $set, $where);
    }
}
