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


    /**
     * CONTROLLA QUESTA FUNZIONE!!! BISOGNA AGGIUNGERE
     * - CONTROLLI SULL'UTENTE
     * - CONTROLLI SULL'OGGETTO PASSATO
     * - CONTROLLI IN CASO SI CERCHI DI CAMBIARE IL "PROPRIO" RUOLO DI ADMIN
     *
     * Change another user's role.
     * Cannot change his own role in order to avoid issues related to "No User Admin" in charge
     * @param string $username The user to whom the Admin has to change the role
     * @param int $new_Role The new role for the user
     */
    public function change_Role($username, $new_Role)
    {
        if($username !== $this->get_Username())
        {
            $username->set_Role($new_Role);
        }
    }
}




