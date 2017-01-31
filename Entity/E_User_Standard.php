<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

class E_User_Standard extends E_User_Basic
{

    public function __construct($username, $password, $email, $up_Count, $last_up = '')
    {
        parent::__construct($username, $password, $email, $up_Count, $last_up);
        parent::set_role(STANDARD);
    }


    /**
     * Enables this user to became a PRO User
     */
    public function become_PRO()
    {
        parent::__construct($this->get_username(), $this->get_password(), $this->get_email(), $this->get_up_Count(), $this->get_last_Upload());
        parent::set_role(PRO);
    }


    /**
     * Checks whether the user can still upload
     * @return bool
     */
    public function can_upload()
    {
        if (parent::get_up_Count <= UPLOAD_STD_LIMIT) //STD User with less or equal to 10 uploads done today
        {
            return TRUE;
        }
        return FALSE;
    }
}