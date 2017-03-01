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
    private $hashedPassword;
    private $email;
    /** @type enum The user role */
    private $role;


    /**
     * Sets the parameters needed to instantiate an User
     *
     * @param string $username This user's username
     * @param string $password This user's password
     * @param string $email This user's email
     */
    public function __construct($username, $password, $email)
    {
        if($this->check_Username($username) === FALSE)
        {
            throw new \Exceptions\input_texts(0, $username);
        }
        $this->set_Username($username);
        $this->set_hashedPassword($password);

        if($this->check_Email($email) === FALSE)
        {
            throw new \Exceptions\input_texts(1, $email);
        }
        $this->set_Email($email);
    }


    /**
     * Sets a new username for the User
     *
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
     * @return bool Whether the title has only a-zA-z0-9 and the $allowed chars
     */
    public static function check_Username($username)
    {
        if(strlen($username) >= MIN_USERNAME_CHARS && strlen($username) <= MAX_USERNAME_CHARS)
        {
            $allowed = array('-', '_', '.'); //Allows -_. inside a Username
            if(ctype_alnum(str_replace($allowed, '', $username))) //Removes the allowed chars and checks whether the string is Alphanumeric
            {
                return TRUE;
            }
        }
        return FALSE;
    }


    /**
     * Sets an ALREADY HASHED password for the User
     *
     * @param string $pass The user's hash('sha512', password)
     */
    public function set_hashedPassword($pass)
    {
        $this->hashedPassword = $pass;
    }


    /**
     * Hashes the password received from the login
     *
     * @param string $pass2hash The password in clear text to hash before save it
     * @return string The hashed password
     */
    public function hash_of($pass2hash)
    {
        return hash('sha512', $pass2hash);
    }


    /**
     * Retrieves the HASHED password of the User
     *
     * @return string The user password
     */
    public function get_Password()
    {
        return $this->hashedPassword;
    }


    /**
     * Sets an email for the User
     *
     * @param string $new_email The user's email
     */
    public function set_Email($new_email)
    {
        $this->email = $new_email;
    }


    /**
     * Checks whether the parameter email is in a correct format
     *
     * @param string $email The email to check if valid
     * @return bool Whether the email is correctly written
     */
    public static function check_Email($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }


    /**
     * Retrieves the email of the User
     *
     * @return string This user's email
     */
    public function get_Email()
    {
        return $this->email;
    }


    /**
     * This function sets a role for the user.
     * It is used in inherited __constructs() and in some role related functions.
     *
     * @param int $new_role The role of the user
     */
    public function set_Role($new_role)
    {
        $this->role = $new_role;
    }


    /**
     * Returns the user's role
     *
     * @return int The user's role
     */
    public function get_Role()
    {
        return $this->role;
    }


    //---ENTITY -> FOUNDATION---\\



    /**
     * Retrieves the user's info from the DB
     *
     * @param string $username
     * @return \Entity\E_User_* An \Entity\E_User object based on the $username's role
     */
    public static function get_UserDetails($username)
    {
        return \Foundation\F_User::get_UserDetails($username);
    }


    /**
     * Checks whether the username is available. Case Sensitive.
     *
     * @param string $username The username to check
     * @return boolean Whether the username is already taken
     */
    public static function is_Available($username)
    {
        return \Foundation\F_User::is_Available($username);
    }


    /**
     * Retrieves the user's password and role. Used to check login credentials
     *
     * @param string $username The user's username
     * @return mixed An ARRAY with user's password and role IF the $username is
     *               stored in the DB, FALSE otherwise
     */
    public static function get_LoginInfo($username)
    {
        return \Foundation\F_User::get_LoginInfo($username);
    }


    /**
     * Retrieves the user's role only
     *
     * @param string $username The user's username
     * @return int The user's role
     */
    public static function get_DB_Role($username)
    {
        return \Foundation\F_User::get_Role($username);
    }


    /**
     * Returns a list of all users with the given role
     *
     * @param int $role The role to search the users for
     * @return array All the users (usernames only) with the specified role
     */
    public static function get_By_Role($role)
    {
        return \Foundation\F_User::get_By_Role($role);
    }


    /**
     * Updates the user's state in the DB
     *
     * @param string $username The user's username
     * @param string $password The user's password
     * @param string $email The user's email
     * @param enum $role The user's role
     * @param type $old_Username The old user's username. Needed in case the user changed username
     */
    public static function update_Profile($username, $password, $email, $role, $old_Username)
    {
        $e_user2Save = new \Entity\E_User($username, $password, $email);
        $e_user2Save->set_Role($role);
        \Foundation\F_User::update_Profile($e_user2Save, $old_Username);
    }


    /**
     * Sets a profile pic for the user
     *
     * @param string $username The user's username
     * @param int $photo_ID The photo ID to save as profile pic
     */
    public static function set_ProfilePic($username, $photo_ID)
    {
        \Foundation\F_User::set_ProfilePic($username, $photo_ID);
    }


    /**
     * Retrieves the user's profile pic (thumbnail style)
     *
     * @param string $username The user owner of the profile pic to search
     * @return image The profile pic, thumbnail style
     */
    public static function get_ProfilePic($username)
    {
        return \Foundation\F_User::get_ProfilePic($username);
    }


    /**
     * Updates the user's profile pic
     *
     * @param string $username The user's username
     * @param int $profile_Pic_ID The ID of the new profile pic
     */
    public static function update_ProfilePic($username, $profile_Pic_ID)
    {
        \Foundation\F_User::update_ProfilePic($username, $profile_Pic_ID);
    }


    /**
     * Removes the user's profile pic
     *
     * @param string $username The user that wants to remove the profile pic
     */
    public static function remove_ProfilePic($username)
    {
        \Foundation\F_User::remove_ProfilePic($username);
    }


    /**
     * Adds a like to the photo
     *
     * @param int $photo_ID The photo's ID
     * @param string $username The user's username
     */
    public static function add_Like_to($photo_ID, $username)
    {
        \Foundation\F_User::add_Like_to($photo_ID, $username);
    }


    /**
     * Removes the user's like from the selected photo
     *
     * @param string $username The user that wants to remove the like
     * @param int $photo_ID The target photo's ID
     */
    public static function remove_Like($username, $photo_ID)
    {
        \Foundation\F_User::remove_Like($username, $photo_ID);
    }







}