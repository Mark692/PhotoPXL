<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foundation;

/**
 * This class allows Standard Users to perform their very functions
 */
class F_User_Standard extends F_User
{

    /**
     * Inserts the user into "users" DB table
     *
     * @param \Entity\E_User_Standard $user The user to insert into the DB
     */
    public static function insert(\Entity\E_User_Standard $user)
    {
        $query = 'INSERT INTO users SET '
                .'`username`=\''.$user->get_Username().'\', '
                .'`password`=\''.$user->get_Password().'\', '
                .'`email`=\''.$user->get_Email().'\', '
                .'`role`=\''.$user->get_Role().'\', '
                .'`last_Upload`=\''.$user->get_Last_Upload().'\', '
                .'`up_Count`=\''.$user->get_up_Count().'\'';

        parent::set($query);
    }



}