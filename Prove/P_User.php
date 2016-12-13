<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Prove;

class P_User extends \Prove\Prove
{

    /**
     * Genera un \Entity\E_User casuale
     * @return E_User object
     */
    public function rnd_E_User()
    {
        $rn_user = parent::rnd_string(7);
        $rn_pass = parent::rnd_string(10);
        $rn_email = parent::rnd_string(rand(3, 10))."@".parent::rnd_string(rand(2, 5)).".".parent::rnd_string(rand(2, 3));
        $rn_role = rand(0, 4);
        $rn_uploads = rand(0, 14);

        return $e_user = new \Entity\E_User($rn_user, $rn_pass, $rn_email, $rn_role, $rn_uploads);
    }
}