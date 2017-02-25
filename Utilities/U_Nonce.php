<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Utilities;

/**
 * HOW TO USE:
 * 1. Registatione - The user inputs his password. E_User will hash it with E_User_Standard->hash_of($input_password)
 *                   Now we have $hashed_pass = hash_of($input_password);
 *                   and we save it to the DB
 *
 * 2. Login - The user inputs his password. We get the nonce of that by using
 *            $login_nonce = $this->generate($login_pass);
 *            Now we can use the $this->pass_isValid($hashed_pass, $login_nonce);
 *
 *            if($this->pass_isValid($hashed_pass, $login_nonce))
 *            {
 *                //Logga l'utente, OK!
 *            }
 *            else
 *            {
 *                //La pass immessa è sbagliata
 *            }
 *
 */
class U_Nonce {

    /**
     * Generate a Nonce.
     * The generated array contains:
     * 1 - Salt.
     * 2 - Hash of salt and pass.
     *
     * @param string $login_pass The hashed user password.
     * @param int $salt_length The length of the salt to generate for the nonce
     * The same value must be passed to the method pass_isValid().
     *
     * @return array The Nonce.
     *
     */
    public static function generate($salt_length = 15) {
        if ($salt_length < 15) { //If the length is less than 15
            $salt_length = 15; //Sets to 15
        }
        $allowed_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $max_chars = strlen($allowed_chars) - 1;
        $salt = '';
        while (strlen($salt) < $salt_length) {
            $salt .= $allowed_chars[rand(0, $max_chars)];
        }

        return $salt;
    }

    /**
     * Check a hashed password against the previously generated Nonce.
     *
     * @param string $db_pass The user hashed password saved in the DB.
     * @param string $nonce.
     * @returns bool Whether the Nonce is valid.
     */
    public static function pass_isValid($db_pass, $nonce, $sent) {

        $DB_nonceHash = hash('sha512', $nonce . $db_pass);
        if ($DB_nonceHash !== $sent) {
            return FALSE;
        }
        return TRUE;
    }

}
