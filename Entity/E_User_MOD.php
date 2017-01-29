<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

class E_User_MOD extends E_User_PRO
{
    private $role = \Utilities\MOD;


    /**
     * Enables the MOD to ban a user if it's not an Admin
     * @param E_User_ $obj_user The user to ban
     */
    public function ban_user($obj_user)
    {
        if($obj_user->get_role() !== \Utilities\Admin)
        {
            $obj_user->set_role(\Utilities\BANNED);
        }
    }




}



