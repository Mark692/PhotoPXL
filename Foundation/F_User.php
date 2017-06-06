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
use Exceptions\queries;
use PDOException;
use Utilities\Roles;
use const DEFAULT_PRO_PIC;
use const USER_PER_PAGE;

/**
 * This is the fundamental class for all other User classes.
 * Defines common function for every user
 */
class F_User extends F_Database
{

    /**
     * Retrieves the user details matching the given $username
     *
     * @param string $username The user's username to search
     * @throws queries In case of connection errors
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
     * @throws queries In case of connection errors
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
     * @throws queries In case of connection errors
     * @return mixed An ARRAY with user's password and role IF the $username is
     *               stored in the DB, FALSE otherwise.
     *               How to access to the array:
     *               - "password" => the user password
     *               - "role" => the user role
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
     * @throws queries In case of connection errors
     * @return mixed int The user's role
     *               boolean FALSE if no username was found in the DB.
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
     * @throws queries In case of connection errors
     * @return array All the users (usernames only) with the specified role.
     *               How to access to the array:
     *               - Numeric Keys => the usernames matching the query
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
     * @throws queries In case of connection errors
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
     * @throws queries In case of connection errors
     */
    public static function change_Password($new_EUser)
    {
        $update = "users";
        $set = array("password" => $new_EUser->get_Password());
        $where = array("username" => $new_EUser->get_Username());

        parent::update($update, $set, $where);
    }


    /**
     * Generates a random string token to be used for password changes purposes.
     *
     * @param string $username The user who wants to change its own password
     */
    public static function generate_Token($username)
    {
        //Generates a token
        if(function_exists('mcrypt_create_iv')) //It exists, but you never know...
        {
            $seed = bin2hex(mcrypt_create_iv(TOKEN_BIN_LENGHT)); //Converts a seed to HEX
        }
        else
        {
            $seed = bin2hex(openssl_random_pseudo_bytes(TOKEN_BIN_LENGHT));
        }

        $token = $seed.time(); //Add timestamp to the seed

        //Saves into Users DB table
        $update = "users";
        $set = array("token" => $token);
        $where = array("username" => $username);

        parent::update($update, $set, $where);

        //DON'T return the token. It can still be used after some time.
        //Simply rethrieve it from the "users" DB table
        //return $token; //TEST ONLY PURPOSES!!!
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
        //Rethrieve the token bound to the user
        $select = array("token");
        $from = "users";
        $where = array("username" => $username);
        $token = parent::get_One($select, $from, $where);
        $token_val = $token["token"];

        if(is_null($token_val)) //The token does not exists
        {
            return FALSE;
        }

        $DB_Token = substr($token_val, 0, -10); //Removes the timestamp
        $token_timestamp = substr($token_val, 2 * TOKEN_BIN_LENGHT); //Removes the token, leaves its timestamp only
        if(time() <= $token_timestamp + TOKEN_LIFETIME) //The token is still valid
        {
            //Compare the tokens - Built-in function
            if(function_exists('hash_equals'))
            {
                return hash_equals($DB_Token, $user_Token);
            }

            //Compare the tokens - Home-made function
            if(strlen($DB_Token) === strlen($user_Token))
            {
                $check = 0;
                $XOR_Tokens = $DB_Token ^ $user_Token;
                //XOR = compares bit against bit.
                //      Sets 1 if the current bits have different values (0 XOR 1, 1 XOR 0)
                //      Sets 0 if both bits have the same value (0 XOR 0, 1 XOR 1)

                for($i = strlen($XOR_Tokens) - 1; $i >= 0; $i--)
                {
                    $check |= ord($XOR_Tokens[$i]); //bitwise OR with each ASCII character of $XOR_Tokens
                }
                return !$check;
            }
        }
        return FALSE;
    }


    /**
     * Resets the token for the user. This may occur when the user successfully logs in
     * or when he succedes to reset his password
     *
     * @param string $username The username whose token has to be resetted
     */
    public static function nullify_Token($username)
    {
        $update = "users";
        $set = array("token" => NULL);
        $where = array("username" => $username);

        parent::update($update, $set, $where);
    }


    /**
     * Changes an user's email
     *
     * @param \Entity\E_User_* $new_EUser The entity user with new details
     * @throws queries In case of connection errors
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
     * @throws queries In case of connection errors
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
     * @throws queries In case of connection errors
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
     * @throws queries In case of connection errors
     * @return array The profile pic, thumbnail style, and its type.
     *               How to access the array:
     *               - "photo" => the profil pic (thumbnail)
     *               - "type" => the image type
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
     * @throws queries In case of connection errors
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
     * @throws queries In case of connection errors
     * @return bool Whether the like has been added or not (case when already present)
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
            return TRUE;
        }
        return FALSE;
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
        $query = "DELETE FROM `likes` "
                ."WHERE (`user`=?) AND (`photo`=?)";

        $toBind = array($username, $photo_ID);

        $pdo = parent::connect();
        $pdo_stmt = $pdo->prepare($query);
        parent::bind_params($pdo_stmt, $toBind);
        try
        {
            $pdo_stmt->execute();
        }
        catch(PDOException $e)
        {
            throw new queries(5, $e);
        }
        $pdo = NULL;

        return boolval($pdo_stmt->rowCount());
    }
}