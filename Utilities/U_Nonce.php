<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Utilities;

/**
 * Nonce generator with variable time-outs.
 */
class U_Nonce
{
    /**
     * Generate a Nonce.
     * The generated array contains:
     * 1 - Salt.
     * 2 - Hash of salt and pass.
     *
     * @param string $h_pass The hashed user password.
     * @param int $salt_length The length of the salt to generate for the nonce
     * The same value must be passed to the method check().
     *
     * @return array The Nonce.
     *
     */
    public static function generate($h_pass, $salt_length = 15)
    {
        if($salt_length<15) //If the length is less than 15
        {
            $salt_length = 15; //Sets to 15
        }
        $allowed_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $max_chars = strlen($allowed_chars) - 1;
        $salt = '';
        while (strlen($salt) < $salt_length)
        {
            $salt .= $allowed_chars[rand(0, $max_chars)];
        }
        $hash = hash('sha512', $salt.$h_pass);
        return $nonce = array($salt, $hash);
    }


    /**
     * Check a hashed password against the previously generated Nonce.
     * @param string $db_pass The user hashed password saved in the DB.
     * @param array $nonce_pass The array generated with generate() method.
     * @returns bool Whether the Nonce is valid.
     */
    public static function check($db_pass, $nonce_pass)
    {
        $n_salt = $nonce_pass[0];
        $n_hash = $nonce_pass[1];

        $check = hash('sha512', $n_salt.$db_pass);
        if ($check !== $n_hash)
        {
            return FALSE;
        }
        return TRUE;
    }
}