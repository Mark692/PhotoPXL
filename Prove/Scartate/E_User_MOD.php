<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Prove\Scartate;

class ScartataE_User_MOD
{


    /**
     * Ban an user IF it's not an ADMIN
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