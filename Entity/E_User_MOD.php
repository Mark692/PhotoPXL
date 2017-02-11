<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

use Utilities\Roles;

/**
 * This class represents the MODerator users.
 * Their function is to ban unwanted users while inheriting all the PRO users functions
 */
class E_User_MOD extends E_User_PRO
{
    /**
     * Instantiates a MOD User
     *
     * @param string $username This user's username
     * @param string $password This user's password
     * @param string $email This user's email
     */
    public function __construct($username, $password, $email)
    {
        parent::__construct($username, $password, $email);
        parent::set_Role(Roles::MOD);
    }


    /**
     * Ban an user IF it's not an ADMIN/MOD
     *
     * @param \Entity\E_User_* $e_user The user to ban
     * @return \Entity\E_User_* The same object user but with role BANNED
     */
    public function ban($e_user)
    {
        $username = $e_user->get_Username();
        if($username !== $this->get_Username()) //If the user IS NOT this MOD (they'll have different usernames...)
        {
            $role = $e_user->get_Role();
            if($role === \Utilities\Roles::ADMIN) //If the user IS NOT an ADMIN
            {
                throw new \Exceptions\roles(3);
            }
            $e_user->set_Role(\Utilities\Roles::BANNED);
        }
        return $e_user;
    }




}



