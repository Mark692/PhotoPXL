<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Prove\Scartate;

class ScartataE_User_ADMIN
{

    /**
     * Change another user's role.
     * Cannot change his own role in order to avoid issues related to "No User Admin" in charge
     *
     * @param \Entity\E_User_* object $user An Entity user to whom change its role
     * @param \Utilities\Roles $new_Role The new role for the user
     * @return \Entity\E_User_* The same object user but with a different role
     */
    public function change_Role($user, \Utilities\Roles $new_Role)
    {
        $username = $user->get_Username();
        if($username === $this->get_Username()) //If the user IS NOT this Admin (they'll have different usernames...)
        {
            throw new \Exceptions\roles(4);
        }
        $user->set_Role($new_Role);
        return $user;
    }
}