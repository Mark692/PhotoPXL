<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foundation;

/**
 * This class contains basic functions to be inherited and overridden by
 * child classes
 */
class F_User extends \Foundation\F_Database
{

    /**
     * Inserts the user into "users" DB table
     *
     * @param \Entity\E_User_Standard $STD_user The new user to insert into the DB
     */
    public static function insert(\Entity\E_User_Standard $STD_user)
    {
        $insertInto = "users";

        $set = array(
            "username" => $STD_user->get_Username(),
            "password" => $STD_user->get_Password(),
            "email" => $STD_user->get_Email(),
            "role" => $STD_user->get_Role(),
            "last_Upload" => $STD_user->get_Last_Upload(),
            "up_Count" => $STD_user->get_up_Count()
                );

        parent::insert_Query($insertInto, $set);
    }


    /**
     * Retrieves the user details matching the given $username
     *
     * @param string $username The user's username to search
     * @return array The array cointaining the user searched for and its profile pic
     */
    public static function get_UserDetails($username)
    {
        //User details from "users" DB table
        $select = "*";
        $from = "users";
        $where = array("username" => $username);
        $user_details = parent::get_One($select, $from, $where);
        $user = self::instantiate_EUser($user_details);
        $pic = self::get_ProfilePic($username);

        return array($user, $pic);
    }


    /**
     * Retrieves the user's profile pic
     *
     * @param string $username The user owner of the profile pic to search
     * @return image The profile pic, thumbnail style
     */
    private static function get_ProfilePic($username)
    {
        $select = "photo";
        $from = "profile_pic";
        $where = array("user" => $username);
        $array_pic = parent::get_One($select, $from, $where);
        return $array_pic[0];
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
        $up_Count = $details["up_Count"];
        $last_up = $details["last_Up"];
        switch ($details["role"])
        {
            case \Utilities\Roles::STANDARD:
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
     * Returns a list of all users with the given role
     *
     * @param enum $role The role to search the users for
     * @param bool $order_DESC Whether to return results in ASCendent or DESCendent style
     * @return array All the users (usernames only) with the specified role
     */
    public static function get_By_Role($role, $limit=0, $offset=0, $orderBy_column='', $order_DESC=FALSE)
    {
        $select = array("username");
        $from = "users";
        $where = array("role" => $role);
        $orderBy_column = "username";

        return $array_user = parent::get_All($select, $from, $where,  $limit, $offset, $orderBy_column, $order_DESC);
    }


    /**
     * Updates a record from the "users" table
     *
     * @param \Entity\E_User $to_Update The user with new details
     * @param string $old_Username The DB username record to refer to
     * @param int $profile_Pic_ID The ID of the new profile pic
     */
    public static function update_Profile(\Entity\E_User $to_Update, $old_Username, $profile_Pic_ID)
    {
        //Updating: Profile Details
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

        //Updating: Profile Pic
        $update = "profile_pic";
        $set = array("photo" => $profile_Pic_ID);
        $where = array("user" => $new_username);

        parent::update($update, $set, $where);
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