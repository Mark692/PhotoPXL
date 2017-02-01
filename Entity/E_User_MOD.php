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
     * CONTROLLA QUESTA FUNZIONE!!! BISOGNA AGGIUNGERE
     * - CONTROLLI SULL'UTENTE
     * - CONTROLLI SULL'OGGETTO PASSATO
     * - CONTROLLI IN CASO SI CERCHI DI BANNARE UN ADMIN
     *
     * Ban an user IF it's not an ADMIN
     * @param string $obj_user The user to ban
     */
    public function ban_user($obj_user)
    {
        $obj_user->set_Role(BANNED);
    }




}



