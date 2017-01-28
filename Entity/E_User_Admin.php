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

        $this->set_role();
    }


    protected function set_role($new_role='')
    {
        if($new_role==='')
        {
            $this->role = \Utilities\ADMIN;
        }
        else
        {
            $this->role = $new_role;
        }
    }


    public function change_Role($obj_User, $new_Role)
    {
        $obj_User->set_role($new_Role);
    }
}




