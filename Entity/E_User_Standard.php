<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

class E_User_Standard extends E_User_Basic
{

    private $role = \Utilities\STANDARD;


    /**
     * Enables this user to became a PRO User
     */
    public function become_PRO()
    {
        $this->role = \Utilities\PRO;
    }


    /**
     * Checks whether the user can still upload
     * @return bool
     */
    public function can_upload()
    {
        if (parent::get_up_Count <= \Utilities\UPLOAD_STD_LIMIT) //STD User with less or equal to 10 uploads done today
        {
            return TRUE;
        }
        return FALSE;
    }
}