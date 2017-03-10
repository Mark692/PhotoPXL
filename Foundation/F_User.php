<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foundation;

use Entity\E_Photo_Blob;
use Entity\E_User_Admin;
use Entity\E_User_Banned;
use Entity\E_User_MOD;
use Entity\E_User_PRO;
use Entity\E_User_Standard;
use Utilities\Roles;
use const DEFAULT_PRO_PIC;
use const USER_PER_PAGE;

class F_User extends F_Database
{

    /**
     * Retrieves the user details matching the given $username
     *
     * @param string $username The user's username to search
     * @return mixed \Entity\E_User_* The user searched
     *               boolean FALSE if no user matchs the given username
     */
    public static function get_UserDetails($username)
    {
        $select = "*";
        $from = "users";
        $where = array("username" => $username);
        $array_user = parent::get_One($select, $from, $where);
        if($array_user === FALSE)
        {
            return FALSE;
        }

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
            case Roles::BANNED:
                $user = new E_User_Banned($username, $password, $email);
                break;

            case Roles::STANDARD:
                $up_Count = $details["up_Count"];
                $last_up = $details["last_Upload"];
                $user = new E_User_Standard($username, $password, $email, $up_Count, $last_up);
                break;

            case Roles::PRO:
                $user = new E_User_PRO($username, $password, $email);
                break;

            case Roles::MOD:
                $user = new E_User_MOD($username, $password, $email);
                break;

            case Roles::ADMIN:
                $user = new E_User_Admin($username, $password, $email);
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
        $query = 'SELECT EXISTS'
                . '('
                    .'SELECT 1 '
                    .'FROM `users` '
                    .'WHERE `username`= BINARY ? '
                    .'LIMIT 1' //Can this speed the query up?
                .') AS available';
        $toBind = array($username);
        $exists = parent::fetch_Result($query, $toBind);

        return boolval(!$exists["available"]);
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
        $select = array("password", "role");
        $from = "users";
        $where = array("username" => $username);
        return parent::get_One($select, $from, $where);
    }


    /**
     * Retrieves the user's role only
     *
     * @param string $username The user's username
     * @return mixed int The user's role
     *               boolean FALSE if no username was found in the DB
     */
    public static function get_Role($username)
    {
        $select = array("role");
        $from = "users";
        $where = array("username" => $username);
        $role = parent::get_One($select, $from, $where);
        if($role === FALSE)
        {
            return FALSE;
        }
        return intval($role["role"]);
    }


    /**
     * Returns a list of all users with the given role
     *
     * @param int $role The role to search the users for
     * @return array All the users (usernames only) with the specified role
     */
    public static function get_By_Role($role, $page_toView = 1)
    {
        $limit = USER_PER_PAGE;
        $offset = USER_PER_PAGE * ($page_toView - 1);

        $select = array("username");
        $from = "users";
        $where = array("role" => $role);

        $array_users = parent::get_All($select, $from, $where, $limit, $offset);
        $username_only = [];
        foreach(array_values($array_users) as $users)
        {
            array_push($username_only, $users);
        }
        return $username_only;
    }


    /**
     * Changes the user's Username
     *
     * @param \Entity\E_User_* $new_EUser The entity user with new details
     * @param string $old The old username, stored in the DB
     */
    public static function change_Username($new_EUser, $old)
    {
        $update = "users";
        $set = array("username" => $new_EUser->get_Username());
        $where = array("username" => $old);

        parent::update($update, $set, $where);
    }


    /**
     * Changes the user's password
     *
     * @param \Entity\E_User_* $new_EUser The entity user with new details
     */
    public static function change_Password($new_EUser)
    {
        $update = "users";
        $set = array("password" => $new_EUser->get_Password());
        $where = array("username" => $new_EUser->get_Username());

        parent::update($update, $set, $where);
    }


    /**
     * Changes an user's email
     *
     * @param \Entity\E_User_* $new_EUser The entity user with new details
     */
    public static function change_Email($new_EUser)
    {
        $update = "users";
        $set = array("email" => $new_EUser->get_Email());
        $where = array("username" => $new_EUser->get_Username());

        parent::update($update, $set, $where);
    }


    /**
     * Updates the profile pic with an existing photo
     *
     * @param string $username The user's username
     * @param int $photo_ID The photo ID to save as profile pic
     */
    public static function set_ProfilePic($username, $photo_ID)
    {
        $query = 'UPDATE `profile_pic`, '
                .'('
                    .'SELECT * '
                    .'FROM `photo` '
                    .'WHERE `id` = ?'
                .') photo '
                .'SET '
                    .'profile_pic.photo = photo.thumbnail, '
                    .'profile_pic.type = photo.type '
                .'WHERE profile_pic.user = ?';
        $toBind = array($photo_ID, $username);
        parent::execute_Query($query, $toBind);
    }


    /**
     * Updates the profile pic by uploading a new photo to be used ONLY as ProPic
     *
     * @param string $username The user's username to update
     * @param E_Photo_Blob $blob The new profile pic to upload for the user
     */
    public static function upload_NewCover($username, E_Photo_Blob $blob)
    {
        $update = "profile_pic";
        $set = array("photo" => $blob->get_Thumbnail(),
                     "type" => $blob->get_Type());
        $where = array("user" => $username);
        parent::update($update, $set, $where);
    }


    /**
     * Retrieves the user's profile pic (thumbnail style)
     *
     * @param string $username The user owner of the profile pic to search
     * @return array The profile pic, thumbnail style, and its type
     */
    public static function get_ProfilePic($username)
    {
        $select = array("photo", "type");
        $from = "profile_pic";
        $where = array("user" => $username);

        return parent::get_One($select, $from, $where); //Can not return FALSE because a default photo will always exist
    }


    /**
     * Removes the user's profile pic and sets the default Profile Pic
     *
     * @param string $username The user that wants to remove the profile pic
     */
    public static function remove_CurrentProPic($username)
    {
        self::set_ProfilePic($username, DEFAULT_PRO_PIC);
    }


    /**
     * Adds a like to the photo
     *
     * @param int $photo_ID The photo's ID
     * @param string $username The user's username
     */
    public static function add_Like_to($photo_ID, $username)
    {
        $query = "SELECT EXISTS"
                ."( "
                    ."SELECT * "
                    ."FROM `likes` "
                    ."WHERE `user`=? AND `photo`=? "
                .") AS ex";
        $toBind = array(
            "user" => $username,
            "photo" => $photo_ID
                );
        $likes_already = parent::fetch_Result($query, $toBind);
        if(!$likes_already["ex"])
        {
            $insertInto = "likes";
            parent::insert_Query($insertInto, $toBind);
        }
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
                ."WHERE (`user`=?) AND (`photo`=?)";

        $toBind = array($username, $photo_ID);
        parent::execute_Query($query, $toBind);
    }
}