<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

class E_User
{
    private $username;
    private $password;
    private $email;

    /**
     * @type enum The user role
     */
    private $role;

    /**
     * @type int Daily counter of total uploaded photos
     */
    private $up_Count;

    /**
     * @type int The Date of the last uploaded photo in time() format
     */
    private $last_Upload;


    /**
     * Sets the parameters needed to instantiate a new User
     * @param string $username
     * @param string $password
     * @param string $email
     */
    public function __construct($username, $password, $email, $up_Count, $last_up='')
    {
        $this->set_username($username);
        $this->set_password($password);
        $this->set_email($email);
        $this->set_up_Count($up_Count);
        $this->set_last_Upload($last_up);
    }


    /**
     * Retrieves the username of the User
     * @return string The user username
     */
    public function get_username()
    {
        return $this->username;
    }


    /**
     * Sets a new username for the User
     * @param string The username input by the user
     * @throws \Exceptions\InvalidInput Thrown in case of non allowed chars in the username
     */
    public function set_username($new_username)
    {
        try
        {
            if($this->check_username($new_username))
            {
                $this->username = $new_username;
            }
            else {throw new \Exceptions\InvalidInput(0, $new_username);}
        }
        catch(\Exceptions\InvalidInput $ex)
        {
            echo($ex->getMessage().nl2br("\r\n"));
        }
    }


    /**
     * Checks whether the username is a valid entry
     * @param string $us The username input
     * @return bool Returns TRUE if the username has only a-zA-z0-9-_. chars
     */
    protected function check_username($us)
    {
        $allowed = array('-', '_', '.'); //Allows -_. inside a Username
        if(ctype_alnum(str_replace($allowed, '', $us))) //Removes the allowed chars and checks whether the string is Alphanumeric
        {
            return TRUE;
        }
        return FALSE;
    }


    /**
     * Retrieves the hashed password of the User
     * @return string The user password
     */
    public function get_password()
    {
        return $this->password;
    }


    /**
     * Sets a new hashed password for the User
     * @param string The user password
     */
    public function set_password($pass)
    {
        $this->password = hash('sha512', $pass);
    }


    /**
     * Retrieves the email of the User
     * @return string
     */
    public function get_email()
    {
        return $this->email;
    }


    /**
     * Sets a new email for the User
     * @param string
     * @throws \Exceptions\InvalidInput
     */
    public function set_email($new_email)
    {
        try
        {
            if(filter_var($new_email, FILTER_VALIDATE_EMAIL) === FALSE)
            {
                throw new \Exceptions\InvalidInput(1, $new_email);
            }
        $this->email = $new_email;
        }
        catch(\Exceptions\InvalidInput $ex)
        {
            echo($ex->getMessage().nl2br("\r\n"));
        }
    }


    protected function set_role($new_role)
    {
        $this->role = $new_role;
    }


    public function get_role()
    {
        return $this->role;
    }


    /**
     * Returns the total of Uploads done today.
     * Resets the Upload count to 0 if the date of the last upload is different from "today"'s date.
     * @return int
     */
    public function get_up_Count()
    {
        if (date('d-m-y', $this->last_Upload) !== date('d-m-y')) //date(...) is a STRING!! Can NOT use < or >
        {
            $this->set_last_Upload();
            $this->reset_Up_Count();
        }
        return $this->up_Count;
    }


    /**
     * Sets the number of uploads done by the user
     * @param int $upc The number of uploads done already
     */
    public function set_up_Count($upc)
    {
        if($upc<0)
        {
            $upc = 0;
        }
        $this->up_Count = $upc;
    }


    /**
     * Increments the count of uploads by 1
     */
    public function add_up_Count()
    {
        $this->up_Count = $this->up_Count + 1;
    }


    /**
     * Resets the Upload Count
     */
    private function reset_Up_Count()
    {
        $this->up_Count = 0;
    }


    /**
     * Gets the last upload date in seconds
     * @return int
     */
    public function get_last_Upload()
    {
        return $this->last_Upload;
    }


    /**
     * Sets the last upload date
     */
    private function set_last_Upload($date = '')
    {
        if ($date==='' || $date<0)
        {
            $date = time();
        }
        $this->last_Upload = $date;
    }
}
