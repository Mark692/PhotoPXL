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
    protected $role;


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
     * @throws \Exceptions\InvalidInput Thrown in case of non allowed chars in the username
     */
    public function set_Username($new_username)
    {
        if($this->check_Username($new_username))
        {
            $this->username = $new_username;
        }
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
     * Sets an username for the User
     *
     * @param string The username input by the user
     */
    public function set_Username($new_username)
    {
        if($this->check_Username($new_username))
        {
            $this->username = $new_username;
        }
    }


    /**
     * Checks whether the username is a valid entry
     *
     * @param string $username The username input
     * @return bool Returns TRUE if the username has only a-zA-z0-9-_. chars
     */
    protected function check_Username($username)
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
     * Retrieves the HASHED password of the User
     * @return string The user password
     */
    public function get_Password()
    {
        return $this->password;
    }


    /**
     * Sets an email for the User
     * @param string The user's email
     * @throws \Exceptions\InvalidInput
     */
    public function set_Email($new_email)
    {
        if(filter_var($new_email, FILTER_VALIDATE_EMAIL) === FALSE)
        {
            throw new \Exceptions\InvalidInput(1, $new_email);
        }
        $this->email = $new_email;
    }


    /**
     * Retrieves the email of the User
     * @return string
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
    protected function set_Role($new_role)
    {
        $this->role = $new_role;
    }


    /**
     * Returns the user's role
     * @return int The user's role
     */
    protected function get_Role()
    {
        return $this->role;
    }
}
