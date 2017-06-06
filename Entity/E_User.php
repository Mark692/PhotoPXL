<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

use Exceptions\input_texts;
use Foundation\F_User;
use const MAX_USERNAME_CHARS;
use const MIN_USERNAME_CHARS;

/**
 * This class implements basic User functions related to login credentials.
 * Also it implements functions about Users Roles to be used in children classes implementations
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
            throw new input_texts(0, $username);
        }
        $this->set_Username($username);
        $this->set_Password($password);

        if($email !== '' && $this->check_Email($email) === FALSE)
        {
            throw new input_texts(1, $email);
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
    private function check_Username($username)
    {
        if(strlen($username) >= MIN_USERNAME_CHARS
                && strlen($username) <= MAX_USERNAME_CHARS)
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
     * Sets a password for the User
     *
     * @param string $pass The user's hashed password
     */
    public function set_Password($pass)
    {
        $this->hashedPassword = $this->hash_of($pass);
    }


    /**
     * Hashes the password received from the login
     *
     * @param string $pass2hash The password in clear text to hash before save it
     * @return string The hashed password
     */
    private function hash_of($pass2hash)
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
    private function check_Email($email)
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


    /**
     * Permits the user to login in the app
     *
     * @return boolean TRUE
     */
    public function canLogin()
    {
        return TRUE;
    }


    //---ENTITY -> FOUNDATION---\\



    /**
     * Retrieves the user's info from the DB
     *
     * @param string $username
     * @throws queries In case of connection errors
     * @return mixed \Entity\E_User_* The user searched
     *               boolean FALSE if no user matchs the given username
     */
    public static function get_UserDetails($username)
    {
        return F_User::get_UserDetails($username);
    }


    /**
     * Checks whether the username is available. Case Sensitive.
     *
     * @param string $username The username to check
     * @throws queries In case of connection errors
     * @return boolean Whether the username is already taken
     */
    public static function is_Available($username)
    {
        return F_User::is_Available($username);
    }


    /**
     * Retrieves the user's password and role. Used to check login credentials
     *
     * @param string $username The user's username
     * @throws queries In case of connection errors
     * @return mixed An ARRAY with user's password and role IF the $username is
     *               stored in the DB, FALSE otherwise.
     *               How to access to the array:
     *               - "password" => the user password
     *               - "role" => the user role
     */
    public static function get_LoginInfo($username)
    {
        return F_User::get_LoginInfo($username);
    }


    /**
     * Retrieves the user's role only
     *
     * @param string $username The user's username
     * @throws queries In case of connection errors
     * @return mixed int The user's role
     *               boolean FALSE if no username was found in the DB
     */
    public static function get_DB_Role($username)
    {
        return F_User::get_Role($username);
    }


    /**
     * Returns a list of all users with the given role
     *
     * @param int $role The role to search the users for
     * @throws queries In case of connection errors
     * @return array All the users (usernames only) with the specified role.
     *               How to access to the array:
     *               - Numeric Keys => the usernames matching the query
     */
    public static function get_By_Role($role, $page_toView = 1)
    {
        return F_User::get_By_Role($role, $page_toView);
    }


    /**
     * Changes the user's Username
     *
     * @param \Entity\E_User_* $new_EUser The entity user with new details
     * @param string $old The old username, stored in the DB
     * @throws queries In case of connection errors
     */
    public static function change_Username($new_EUser, $old)
    {
        F_User::change_Username($new_EUser, $old);
    }


    /**
     * Changes the user's password
     *
     * @param \Entity\E_User_* $new_EUser The entity user with new details
     * @throws queries In case of connection errors
     */
    public static function change_Password($new_EUser)
    {
        F_User::change_Password($new_EUser);
    }


    /**
     * Generates a random string token to be used for password changes purposes.
     *
     * @param string $username The user who wants to change its own password
     */
    public static function generate_Token($username)
    {
        F_User::generate_Token($username);
    }

    /**
     * Verifies whether the user token is valid
     *
     * @param string $username The user trying to change its password
     * @param string $user_Token The user token
     * @return boolean Whether everything is correct
     */
    public static function check_Token($username, $user_Token)
    {
        F_User::check_Token($username, $user_Token);
    }


    /**
     * Resets the token for the user. This may occur when the user successfully logs in
     * or when he succedes to reset his password
     *
     * @param string $username The username whose token has to be resetted
     */
    public static function nullify_Token($username)
    {
        F_User::nullify_Token($username);
    }


    /**
     * Changes an user's email
     *
     * @param \Entity\E_User_* $new_EUser The entity user with new details
     * @throws queries In case of connection errors
     */
    public static function change_Email($new_EUser)
    {
        F_User::change_Email($new_EUser);
    }


    /**
     * Updates the profile pic with an existing photo
     *
     * @param string $username The user's username
     * @param int $photo_ID The photo ID to save as profile pic
     * @throws queries In case of connection errors
     */
    public static function set_ProfilePic($username, $photo_ID)
    {
        F_User::set_ProfilePic($username, $photo_ID);
    }


    /**
     * Updates the profile pic by uploading a new photo to be used ONLY as ProPic
     *
     * @param string $username The user's username to update
     * @param E_Photo_Blob $blob The new profile pic to upload for the user
     * @throws queries In case of connection errors
     */
    public static function upload_NewCover($username, E_Photo_Blob $blob)
    {
        F_User::upload_NewCover($username, $blob);
    }


    /**
     * Retrieves the user's profile pic (thumbnail style)
     *
     * @param string $username The user owner of the profile pic to search
     * @throws queries In case of connection errors
     * @return array The profile pic, thumbnail style, and its type.
     *               How to access the array:
     *               - "photo" => the profil pic (thumbnail)
     *               - "type" => the image type
     */
    public static function get_ProfilePic($username)
    {
        return F_User::get_ProfilePic($username);
    }


    /**
     * Removes the user's profile pic
     *
     * @param string $username The user that wants to remove the profile pic
     * @throws queries In case of connection errors
     */
    public static function remove_CurrentProPic($username)
    {
        F_User::remove_CurrentProPic($username);
    }


    /**
     * Adds a like to the photo
     *
     * @param int $photo_ID The photo's ID
     * @param string $username The user's username
     * @throws queries In case of connection errors
     * @return bool Whether the like has been added or not (case when already present)
     */
    public static function add_Like_to($photo_ID, $username)
    {
        return F_User::add_Like_to($photo_ID, $username);
    }


    /**
     * Removes the user's like from the selected photo
     *
     * @param string $username The user that wants to remove the like
     * @param int $photo_ID The target photo's ID
     * @throws queries In case of connection errors
     * @return bool Whether the like was removed successfully or not
     */
    public static function remove_Like($username, $photo_ID)
    {
        return F_User::remove_Like($username, $photo_ID);
    }
}