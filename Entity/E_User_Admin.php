<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

class E_User_Admin extends E_User_MOD
{

    public function __construct($username, $password, $email, $up_Count, $last_up = '')
    {
        parent::__construct($username, $password, $email, $up_Count, $last_up);
        parent::set_role(ADMIN);
    }


    /**
     *
     * @param \Entity\E_User $obj_User The user to whom the Admin has to change the role
     * @param enum $new_Role The new role for the user
     */
    public function change_Role(\Entity\E_User $obj_User, $new_Role)
    {
        $obj_User->set_role($new_Role);
    }
}




