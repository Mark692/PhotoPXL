<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

use Utilities\Roles;

/**
 * This class represents a Standard User which has some limitation in its functions.
 * Limitations:
 * - Limited number of daily uploads
 * - All its photos are public, means that everybody logged in can see them
 */
class E_User_Banned extends E_User
{

    /**
     * Instantiates a Banned User object.
     * This user has limited uploads and no rights to set reserved photos
     *
     * @param string $username This user's username
     * @param string $password This user's password
     * @param string $email This user's email
     */
    public function __construct($username, $password, $email)
    {
        parent::__construct($username, $password, $email);
        parent::set_Role(Roles::BANNED);
    }


    /**
     * Negates the user to upload any photo
     *
     * @return boolean FALSE 
     */
    public function canUpload()
    {
        return FALSE;
    }
}

