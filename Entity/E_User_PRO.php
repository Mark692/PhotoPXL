<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

use Utilities\Roles;

/**
 * This class represents higher level users than Standard ones.
 * PRO Users are able to set a privacy to their photos and are not limited in daily uploads
 */
class E_User_PRO extends E_User
{
    /**
     * Instantiates a PRO User
     *
     * @param string $username This user's username
     * @param string $password This user's password
     * @param string $email This user's email
     */
    public function __construct($username, $password, $email)
    {
        parent::__construct($username, $password, $email);
        parent::set_Role(Roles::PRO);
    }



    /**
     * Sets the Photo privacy as
     * Reserved (TRUE):  only certain users will be able to see the photo
     * Public  (FALSE): ALL users will be able to see the photo
     *
     * @param \Entity\E_Photo $photo_ID The photo object to set the privacy
     * @param bool $privacy The privacy setting for the photo
     */
    public function set_Reserved(\Entity\E_Photo $photo_ID, $privacy)
    {
        if(is_bool($privacy))
        {
            $photo_ID->set_privacy($privacy);
        }
    }



}