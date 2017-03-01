<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foundation;

use \PDO;

class F_User extends \Foundation\F_Database
{

    /**
     * Retrieves the user details matching the given $username
     *
     * @param string $username The user's username to search
     * @return \Entity\E_User_* The user searched
     */
    public static function get_UserDetails($username)
    {
        $select = "*";
        $from = "users";
        $where = array("username" => $username);
        $array_user = parent::get_One($select, $from, $where);

        return self::instantiate_EUser($array_user);
    }


    /**
     * Instantiates an \Entity\E_User_* user according to its role
     *
     * @param array $details The user details fetched from a query
     * @return \Entity\E_User_* The right user according to its role
     */
    private static function instantiate_EUser($details)
    {
        $username = $details["username"];
        $password = $details["password"];
        $email = $details["email"];
        switch ($details["role"])
        {
            case \Utilities\Roles::BANNED:
                $user = new \Entity\E_User_Banned($username, $password, $email);
                break;

            case \Utilities\Roles::STANDARD:
                $up_Count = $details["up_Count"];
                $last_up = $details["last_Up"];
                $user = new \Entity\E_User_Standard($username, $password, $email, $up_Count, $last_up);
                break;

            case \Utilities\Roles::PRO:
                $user = new \Entity\E_User_PRO($username, $password, $email);
                break;

            case \Utilities\Roles::MOD:
                $user = new \Entity\E_User_MOD($username, $password, $email);
                break;

            case \Utilities\Roles::ADMIN:
                $user = new \Entity\E_User_ADMIN($username, $password, $email);
                break;
        }
        return $user;
    }


    /**
     * Checks whether the username is available. Case Sensitive.
     *
     * @param string $username The username to check
     * @return boolean Whether the username is already taken
     */
    public static function is_Available($username)
    {
        $query = 'SELECT EXISTS('
                    .'SELECT 1 '
                    .'FROM `users` '
                    .'WHERE `username`= BINARY ? '
                    .'LIMIT 1'
                .')';
        $toBind = array($username);
        $pdo = parent::connect();
        $pdo_stmt = $pdo->prepare($query);
        parent::bind_params($pdo_stmt, $toBind);
        $pdo_stmt->execute();
        $pdo = NULL;

        $exists = $pdo_stmt->fetch(PDO::FETCH_NUM);
        if($exists[0] == 1) // if($exists[0] === "1")
        {
            return TRUE;
        }
        return FALSE;
    }


    /**
     * Retrieves the user's password and role. Used to check login credentials
     *
     * @param string $username The user's username
     * @return array The user's password and role
     */
    public static function get_LoginInfo($username)
    {
        $select = array("password", "role");
        $from = "users";
        $where = array("username" => $username);
        return parent::get_One($select, $from, $where);
    }


    /**
     * Retrieves the user's role only
     *
     * @param string $username The user's username
     * @return int The user's role
     */
    public static function get_Role($username)
    {
        $select = array("role");
        $from = "users";
        $where = array("username" => $username);
        $role = parent::get_One($select, $from, $where);
        return $role["role"];
    }


    /**
     * Returns a list of all users with the given role
     *
     * @param int $role The role to search the users for
     * @return array All the users (usernames only) with the specified role
     */
    public static function get_By_Role($role)
    {
        $select = array("username");
        $from = "users";
        $where = array("role" => $role);

        return $array_user = parent::get_All($select, $from, $where);
    }


    /**
     * Updates a record from the "users" table
     *
     * @param \Entity\E_User_* $to_Update The entity user with new details
     * @param string $old_Username The DB username record to refer to
     * @param int $profile_Pic_ID The ID of the new profile pic
     */
    public static function update_Profile($to_Update, $old_Username)
    {
        $update = "users";
        $new_username = $to_Update->get_Username();
        $set = array( //Array to pass at the parent::set() function to Bind the correct parameters
            "username" => $new_username,
            "password" => $to_Update->get_Password(),
            "email" => $to_Update->get_Email(),
            "role" => $to_Update->get_Role()
                );
        $where = array("username" => $old_Username);

        parent::update($update, $set, $where);
    }


    /**
     * Sets a profile pic for the user
     * @param string $username The user's username
     * @param int $photo_ID The photo ID to save as profile pic
     */
    public static function set_ProfilePic($username, $photo_ID)
    {
        $insertInto = "profile_pic";
        $set = array(
            "username" => $username,
            "photo" => $photo_ID
                );
        parent::insert_Query($insertInto, $set);
    }


    /**
     * Retrieves the user's profile pic (thumbnail style)
     *
     * @param string $username The user owner of the profile pic to search
     * @return image The profile pic, thumbnail style
     */
    public static function get_ProfilePic($username)
    {
        $query = 'SELECT `thumbnail` '
                .'FROM `photo` '
                    .'INNER JOIN `profile_pic` '
                    .'ON photo.id = profile_pic.photo '
                .'WHERE profile_pic.user = ?';
        $toBind = array($username);
        $proPic = parent::fetch_Result($query, $toBind);
        return $proPic["thumbnail"];
    }


    /**
     * Updates the user's profile pic
     *
     * @param string $username The user's username
     * @param int $profile_Pic_ID The ID of the new profile pic
     */
    public static function update_ProfilePic($username, $profile_Pic_ID)
    {
        $update = "profile_pic";
        $set = array("photo" => $profile_Pic_ID);
        $where = array("user" => $username);

        parent::update($update, $set, $where);
    }


    /**
     * Removes the user's profile pic
     *
     * @param string $username The user that wants to remove the profile pic
     */
    public static function remove_ProfilePic($username)
    {
        $query = "DELETE FROM `profile_pic` "
                ."WHERE (`user`=?)";

        $toBind = array($username);
        parent::execute_Query($query, $toBind);
    }


    /**
     * Adds a like to the photo
     *
     * @param int $photo_ID The photo's ID
     * @param string $username The user's username
     */
    public static function add_Like_to($photo_ID, $username)
    {
        $insertInto = "likes";
        $set = array(
            "user" => $username,
            "photo" => $photo_ID
                );

        parent::insert_Query($insertInto, $set);
    }


    /**
     * Removes the user's like from the selected photo
     *
     * @param string $username The user that wants to remove the like
     * @param int $photo_ID The target photo's ID
     */
    public static function remove_Like($username, $photo_ID)
    {
        $query = "DELETE FROM `likes` "
                ."WHERE (`username`=?) AND (`photo`=?)";

        $toBind = array($username, $photo_ID);
        parent::execute_Query($query, $toBind);
    }


}