<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

class E_User_MOD extends E_User_PRO
{
    public function __construct($username, $password, $email, $up_Count, $last_up = '')
    {
        parent::__construct($username, $password, $email, $up_Count, $last_up);
        parent::set_role(MOD);
    }


    /**
     * Enables the MOD to ban a user if it's not an Admin
     * @param \Entity\E_User $obj_user The user to ban
     */
    public function ban_user(\Entity\E_User $obj_user)
    {
        if($obj_user->get_role() !== ADMIN)
        {
            $obj_user->set_role(BANNED);
        }
    }




}



