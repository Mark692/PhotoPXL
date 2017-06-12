<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

use Foundation\F_User_Standard;
use Utilities\Roles;
use const UPLOAD_STD_LIMIT;

/**
 * This class represents a Standard User which has some limitations in its functions.
 * Limitations:
 * - Limited number of daily uploads
 * - All its photos are public, means that everybody logged in can see them
 */
class E_User_Standard extends E_User
{
    /** @type int The Date of the last uploaded photo in time() format */
    private $last_Upload;

    /** @type int Daily counter of total uploaded photos */
    private $up_Count;


    /**
     * Instantiates a Standard User object.
     * This user has limited uploads and no rights to set reserved photos
     *
     * @param string $username This user's username
     * @param string $password This user's password
     * @param string $email This user's email
     * @param int $up_Count The number of uploads done
     * @param int $last_up The timestamp of last upload
     */
    public function __construct($username, $password, $email, $up_Count = 0, $last_up = 0)
    {
        parent::__construct($username, $password, $email);
        parent::set_Role(Roles::STANDARD);

        $this->set_up_Count($up_Count);

        if($last_up <= 0)
        {
            $last_up = time();
        }
        $this->set_Last_Upload($last_up);
    }


    /**
     * Sets the last upload date
     *
     * @param int $date The timestamp of this user's last upload
     */
    public function set_Last_Upload($date)
    {
        $this->last_Upload = $date;
    }


    /**
     * Gets the last upload date in timestamp format
     *
     * @return int The timestamp of this user's last upload
     */
    public function get_Last_Upload()
    {
        return $this->last_Upload;
    }


    /**
     * Sets the number of uploads done by the user
     *
     * @param int $upc The number of uploads done already
     */
    public function set_up_Count($upc)
    {
        $this->up_Count = $upc;
    }


    /**
     * Returns the total of Uploads done today.
     * Resets the Upload count to 0 if the date of the last upload is different from "today"'s date.
     *
     * @return int The number of uploads done today by this user
     */
    public function get_up_Count()
    {
        return $this->up_Count;
    }


    /**
     * Increments the count of uploads by 1 and sets the last upload date to now
     */
    public function add_up_Count()
    {
        $this->up_Count = $this->up_Count + 1;
        $this->set_Last_Upload(time());
    }


    /**
     * Resets the Upload Count
     */
    private function reset_Up_Count()
    {
        $this->up_Count = 0;
    }


    /**
     * Checks whether the user can still upload
     *
     * @return bool Returns TRUE if the user can upload at least 1 more photo
     */
    public function can_Upload()
    {
        if(date('d-m-y', $this->last_Upload) !== date('d-m-y'))
        {
            $this->reset_Up_Count();
        }

        if($this->get_up_Count() < UPLOAD_STD_LIMIT)
        {
            return TRUE;
        }
        return FALSE;
    }



    //---ENTITY -> FOUNDATION---\\


    /**
     * Inserts the user into "users" DB table
     *
     * @param E_User_Standard $STD_user The new user to insert into the DB
     * @throws queries In case of connection errors
     */
    public static function insert(E_User_Standard $STD_user)
    {
        F_User_Standard::insert($STD_user);
    }


    /**
     * Updates the "last_Upload" and the "up_Count" of the user
     *
     * @param E_User_Standard $STD_user The user uploading a photo
     * @throws queries In case of connection errors
     */
    public static function update_Counters(E_User_Standard $STD_user)
    {
        F_User_Standard::update_Counters($STD_user);
    }


    /**
     * Upgrades the user's role to PRO
     *
     * @param string $username The user's username
     * @throws queries In case of connection errors
     */
    public static function becomePRO($username)
    {
        F_User_Standard::becomePRO($username);
    }
}