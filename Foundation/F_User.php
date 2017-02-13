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
     * @param \Entity\E_User_* $e_user The user to insert into the DB
     */
    public static function insert($e_user)
    {
        //PRO, MOD, Admin user setup
        $query = 'INSERT INTO `users` SET '
                .'`username`=?, '
                .'`password`=?, '
                .'`email`=?, '
                .'`role`=?';

        $role = $e_user->get_Role();

        $toBind = array( //Array to pass at the parent::set() function to Bind the correct parameters
            $e_user->get_Username(),
            $e_user->get_Password(),
            $e_user->get_Email(),
            $role);

        //STANDARD user setup
        if($role === \Utilities\Roles::STANDARD)
        {
            $query .= ', '
                .'`last_Upload`=?, '
                .'`up_Count`=?';

            array_push($toBind, $e_user->get_Last_Upload());
            array_push($toBind, $e_user->get_up_Count());
        }
        parent::execute_query($query, $toBind);
    }


    /**
     * Retrieves the user details matching the given $username
     *
     * @param string $username The user's username to search
     * @return \Entity\E_User_* The entity user according to the role chosen
     */
    public static function get_By_Username($username)
    {
        //User details from "users" DB table
        //SELECT * is implicitly defined
        $from = "users";
        $where = array("username" => $username);
        $user_details = parent::get($where, $from);
        $user = self::instantiate_EUser($user_details);

        //User profile pic from "profile_pic" DB table
        $select = "photo";
        $from = "profile_pic";
        $where = array("user" => $username);
        $pro_pic = parent::get($where, $from, $select);

        return array($user, $pro_pic[0]);
    }


    /**
     * Returns a list of all users with the given role
     *
     * @param enum $role The role to search the users for
     * @param bool $order_DESC Whether to return results in ASCendent or DESCendent style
     * @return array All the users (usernames only) with the specified role
     */
    public static function get_By_Role($role, $order_DESC=FALSE)
    {
        $select = "username";
        $from = "users";
        $where = array("role" => $role);
        $fetchAll = TRUE;
        $orderBy_column = "username";

        return $array_user = parent::get($where, $from, $select, $fetchAll, $orderBy_column, $order_DESC);
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
        $query = 'INSERT INTO `likes` SET '
                .'`user`=?, '
                .'`photo`=?';
        $toBind = array($username, $photo_ID);
        parent::execute_query($query, $toBind);
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
        parent::execute_query($query, $toBind);
    }


}