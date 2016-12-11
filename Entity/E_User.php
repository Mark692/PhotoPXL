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
     * Roles that describe each user
     * @type int
     */
    //const BANNED = 0;
    //const STANDARD = 1;
    //const PRO = 2;
    //const MOD = 3;
    //const ADMIN = 4;

    private $role = 1; //Default is STANDARD USER

    /**
     * Daily counter of total uploaded photos
     * @type int
     */
    private $up_Count;

    /**
     * Holds the Date of the last uploaded photo in "d-m-y" format
     * @type string "d-m-y"
     */
    private $last_Upload;



    /**
     * Sets the parameters needed to instantiate a new User
     * @param string $username
     * @param string $password
     * @param string $email
     * @param int $role
     * @param int $up_Count
     * @param string $last_up
     */
    public function __construct($username, $password, $email, $role, $up_Count, $last_up='')
    {
        $this->username = $username;
        $this->password = $password;
        $this->email = filter_var($email, FILTER_VALIDATE_EMAIL);
        $this->role = $role;
        $this->up_Count = $up_Count;
        if ($last_up == '')
        {
            $this->set_last_Upload();
        }
        else {$this->last_Upload = $last_up;}
    }


    /**
     * Retrieves the username of the User
     * @return string
     */
    public function get_username()
    {
        return $this->username;
    }


    /**
     * Sets a new username for the User
     * @param string
     */
    public function set_username($new_username)
    {
        $this->username = $new_username;
    }


    /**
     * Retrieves the hashed password of the User
     * @return string
     */
    public function get_password()
    {
        return $this->password;
    }

    /**
     * Sets a new hashed password for the User
     * @param string
     */
    public function set_password($new_pass)
    {
        $this->password = $new_pass;
    }


    /**
     * Retrieves the email of the User
     * @return string
     */
    public function get_mail()
    {
        return $this->email;
    }


    /**
     * Sets a new email for the User
     * @param string
     */
    public function set_mail($new_email)
    {
        $this->email = filter_var($new_email, FILTER_VALIDATE_EMAIL);
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
     */
    public function set_role($new_role)
    {
        global $config;
        if ($new_role >= 0 && $new_role <= count($config))
        {
            $this->role = $new_role;
        }
    }


    /**
     * Promotes the user to the next ranking role
     * @return bool
     */
    public function promote()
    {
        global $config;
        if ($this->role < count($config))
        {
            $this->role = $this->role + 1;
            return TRUE;
        }
        return FALSE;
    }


    /**
     * Demotes the user to the previous ranking role
     * @return bool
     */
    public function demote()
    {
        if ($this->role > 0)
        {
            $this->role = $this->role - 1;
            return TRUE;
        }
        return FALSE;
    }


    /**
     * Returns the total of Uploads done today.
     * Resets the Upload count to 0 if the date of the last upload is different from "today"'s date.
     * @return int
     */
    public function get_up_Count()
    {
        if ($this->last_Upload != date("d-m-y")) //date(...) is a STRING!! Can NOT use < or >
        {
            $this->set_last_Upload();
            $this->reset_Up_Count();
        }
        return $this->up_Count;
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
     * Gets the last upload date
     * @return string format "d-m-y"
     */
    public function get_last_Upload()
    {
        return $this->last_Upload;
    }


    /**
     * Sets the last upload date
     */
    private function set_last_Upload()
    {
        $this->last_Upload = date("d-m-y");
    }


    /**
     * Checks if the user can still upload
     * @return bool
     */
    public function can_upload()
    {
        global $config;
        $std_role = array_search('Standard', $config['user']);
        $std_max = $config['upload_limit']['Standard'];
        $this->up_Count = $this->get_up_Count();

        if ($this->role > $std_role) //If the user is PRO at least...
        {
            return TRUE;
        }
        elseif ($this->role == $std_role && $this->up_Count < $std_max) //STD User with less than 10 uploads done today
        {
            return TRUE;
        }
        return FALSE;
    }

}
