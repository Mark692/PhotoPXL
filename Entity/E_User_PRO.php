<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

class E_User_PRO extends E_User_Basic
{
    public function __construct($username, $password, $email, $up_Count, $last_up = '')
    {
        parent::__construct($username, $password, $email, $up_Count, $last_up);
        parent::set_role(PRO);
    }


    /**
     *
     * Sets the Photo privacy as
     * Reserved (if $privacy === TRUE):  only certain users will be able to see the photo
     * Public   (if $privacy === FALSE): ALL users will be able to see the photo
     * @param \Entity\E_Photo object The photo object to set the privacy
     * @param bool $privacy The privacy setting for the photo
     */
    public function set_privacy(\Entity\E_Photo $obj_photo, bool $privacy)
    {
        $obj_photo->set_privacy($privacy);
    }
}