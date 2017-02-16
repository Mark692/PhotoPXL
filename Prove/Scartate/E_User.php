<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Prove\Scartate;

class ScartataE_User
{


    /**
     * This function helps converting an user into an array to ease those functions in
     * Foundation that require an array and not an E_User
     *
     * @param \Entity\E_User_* $e_user An user to convert into an array
     * @return array An array made of user details to be used in Foundation functions
     */
    public function to_Array($e_user)
    {
        $role = $e_user->get_Role();
        $user_details = array(
            "username" => $e_user->get_Username(),
            "password" => $e_user->get_Password(),
            "email" => $e_user->get_Email(),
            $role
            );

        if($role === \Utilities\Roles::STANDARD)
        {
            $to_merge = array(
                "last_Upload" => $e_user->get_Last_Upload(),
                "up_Count" => $e_user->get_up_Count()
                );
            $user_details = array_merge($user_details, $to_merge); //"Pushes" the array $to_merge at the end of $user_details
        }

        return $user_details;
    }
}