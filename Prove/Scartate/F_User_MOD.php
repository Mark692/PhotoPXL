<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Prove\Scartate;

class ScartataF_Database
{

//----SCARTATA PERCHè NON CONTROLLA SE L'UTENTE DA BANNARE SIA UN ADMIN----\\
//----Sostituita con l'attuale funzione che prende, come parametro, l'intero oggetto E_User_*----\\
    /**
     * Bans a user changing its role to 0. This method accepts an associative array
     * to check the user details before ban him
     *
     * @param array $user_details The user to ban. The parameter is an associative array
     */
    public static function ban($user_details)
    {
        $banned_user = array(
            "role" => \Utilities\Roles::BANNED
            //May add here more options/restrictions for the banned users
            );
        parent::update($banned_user, $user_details);
    }
}
