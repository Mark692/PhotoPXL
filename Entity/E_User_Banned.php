<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

use Utilities\Roles;

/**
 * This class represents a Banned User which has fully limited functions.
 * Limitations:
 * - No login
 * - No uploads
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
     * Negates the user to login in the app
     *
     * @return boolean FALSE
     */
    public function canLogin()
    {
        return FALSE;
    }


    /**
     * Negates the user to upload any photo
     *
     * @return boolean FALSE
     */
    public function can_Upload()
    {
        return FALSE;
    }
}

