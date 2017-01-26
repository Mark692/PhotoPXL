<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

/**
 * This class defines the attributes of each user
 */
class E_User
{

    private $username;
    private $password;
    private $email;

    /**
     * @type int The Role number that describes each user
     */
    //BANNED = 0; STANDARD = 1; PRO = 2; MOD = 3; ADMIN = 4;
    private $role; //Default is STANDARD USER

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
     * @param int $role
     * @param int $up_Count
     * @param int $last_up
     */
    public function __construct($username, $password, $email, $role, $up_Count, $last_up='')
    {
        $this->set_username($username);
        $this->set_password($password);
        $this->set_email($email);
        $this->set_role($role);
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
    private function check_username($us)
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


    //TO DO: ABILITA L'HASH DELLA PASS. RICORDA CHE PRENDI LA PASS CRITTATA CON IL NONCE
    //QUINDI VA PRIMA DECRITTATA DAL NONCE E POI CRITTATA CON SHA512+SALT
    /**
     * Sets a new hashed password for the User
     * @param string The user password
     */
    public function set_password($pass, $nonce='')
    {
        if($nonce!=='')
        {
            $pass = decryptNonce(); //IMPLEMETA STA ROBBA!!
        }
        global $config; //To rethrive the salt
        $pass = hash('sha512', $pass.$config['salt']);
        $this->password = $pass;
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


    /**
     * Retrieves the role of the User
     * @return int
     */
    public function get_role()
    {
        return $this->role;
    }


    /**
     * Sets a new role for the User if $new_role is a valid entry
     * @param int $new_role
     * @throws \Exceptions\UserRole
     */
    public function set_role($new_role)
    {
        try
        {
            global $config;
            if ($new_role >= 0 && $new_role < count($config['user']))
            {
                $this->role = $new_role;
            }
            else {throw new \Exceptions\UserRole(0, $new_role);}
        }
        catch(\Exceptions\UserRole $ex)
        {
            echo($ex->getMessage().nl2br("\r\n"));
        }
    }


    /**
     * Promotes the user to the next ranking role; returns TRUE only if promoted successfully
     * @return bool
     * @throws \Exceptions\UserRole
     */
    public function promote()
    {
        try
        {
            global $config;
            if ($this->role < count($config['user'])-1) //count() inizia da 1 ma gli utenti inseriti partono da 0 quindi l'ultimo elemento è count()-1
            {
                $this->role = $this->role + 1;
            }
            else {throw new \Exceptions\UserRole(1);}
        }
        catch(\Exceptions\UserRole $ex)
        {
            echo($ex->getMessage().nl2br("\r\n"));
        }
    }


    /**
     * Demotes the user to the previous ranking role; returns TRUE only if demoted successfully
     * @return bool
     * @throws \Exceptions\UserRole
     */
    public function demote()
    {
        try
        {
            if ($this->role > 0)
            {
                $this->role = $this->role - 1;
            }
            else {throw new \Exceptions\UserRole(2);}
        }
        catch(\Exceptions\UserRole $ex)
        {
            echo($ex->getMessage().nl2br("\r\n"));
        }
    }


    /**
     * Returns the total of Uploads done today.
     * Resets the Upload count to 0 if the date of the last upload is different from "today"'s date.
     * @return int
     */
    public function get_up_Count()
    {
        if (date('d-m-y', $this->last_Upload) != date('d-m-y')) //date(...) is a STRING!! Can NOT use < or >
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


    /**
     * Checks whether the user can still upload
     * @return bool
     */
    public function can_upload()
    {
        global $config;
        $std_role = array_search('Standard', $config['user']);
        $std_max_up = $config['upload_limit']['Standard'];
        $this->get_up_Count();

        if ($this->role > $std_role) //If the user is PRO at least...
        {
            return TRUE;
        }
        elseif ($this->role == $std_role && $this->up_Count < $std_max_up) //STD User with less than 10 uploads done today
        {
            return TRUE;
        }
        return FALSE;
    }
}
