<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

/**
 * This class implements basic User functions related to login credentials
 * Also it implements functions about Users Roles to be used in children implementations
 */
class E_User
{
    private $username;
    private $password;
    private $email;

    /**
     * @type int The user role
     */
    private $role;


    /**
     * Sets the parameters needed to instantiate an User
     *
     * @param string $username This user's username
     * @param string $password This user's password
     * @param string $email This user's email
     */
    protected function __construct($username, $password, $email)
    {
        $this->set_Username($username);
        $this->set_Password($password);
        $this->set_Email($email);
    }


    /**
     * Sets a new username for the User
     * @param string The username input by the user
     */
    public function set_Username($new_username)
    {
        $this->username = $new_username;
    }


    /**
     * Retrieves the username of the User
     *
     * @return string The user username
     */
    public function get_Username()
    {
        return $this->username;
    }


    /**
     * Checks whether the username is a valid entry
     *
     * @param string $username The username input
     * @return bool Returns TRUE if the username has only a-zA-z0-9-_. chars
     */
    public static function username_isValid($username)
    {
        $allowed = array('-', '_', '.'); //Allows -_. inside a Username
        if(ctype_alnum(str_replace($allowed, '', $username))) //Removes the allowed chars and checks whether the string is Alphanumeric
        {
            return TRUE;
        }
        return FALSE;
    }


    /**
     * Sets an ALREADY HASHED password for the User
     * @param string $pass The user's hash('sha512', password)
     */
    public function set_Password($pass)
    {
        $this->password = $pass;
    }


    /**
     * Hashes the password received from the login
     * @param string $pass2hash The password in clear text to hash before save it
     * @return string The hashed password
     */
    public static function hash_of($pass2hash)
    {
        return hash('sha512', $pass2hash);
    }


    /**
     * Retrieves the HASHED password of the User
     * @return string The user password
     */
    public function get_Password()
    {
        return $this->password;
    }


    /**
     * Sets an email for the User
     * @param string $new_email The user's email
     */
    public function set_Email($new_email)
    {
        $this->email = $new_email;
    }


    /**
     * Checks whether the parameter email is in a correct format
     * @param string $email The email to check if valid
     * @return bool Whether the email is correctly written
     */
    public static function email_isValid($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }


    /**
     * Retrieves the email of the User
     * @return string This user's email
     */
    public function get_Email()
    {
        return $this->email;
    }


    /**
     * This function sets a role for the user.
     * It is used in children __constructs() and in some role related functions.
     *
     * @param int $new_role The role of the user
     */
    public function set_Role($new_role)
    {
        $this->role = $new_role;
    }


    /**
     * Returns the user's role
     * @return int The user's role
     */
    public function get_Role()
    {
        return $this->role;
    }
}
