<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

use Utilities\Roles;

/**
 * This class represents the highest level users. They can change roles to other users
 * while inheriting all the MOD users functions
 */
class E_User_Admin extends E_User_MOD
{

    /**
     * Instantiates an ADMIN User
     *
     * @param string $username This user's username
     * @param string $password This user's password
     * @param string $email This user's email
     */
    public function __construct($username, $password, $email)
    {
        parent::__construct($username, $password, $email);
        parent::set_Role(Roles::ADMIN);
    }



    //---ENTITY -> FOUNDATION---\\


    /**
     * Changes an user's role
     *
     * @param string $username The user's username
     * @param int $new_Role The user's new role
     */
    public static function change_role($username, $new_Role)
    {
        \Foundation\F_User_Admin::change_role($username, $new_Role);
    }
}




