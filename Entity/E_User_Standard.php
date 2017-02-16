<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

use Utilities\Roles;

/**
 * This class represents a Standard User which has some limitation in its functions.
 * Limitations:
 * - Limited number of daily uploads
 * - All its photos are public, means that everybody logged in can see them
 */
class E_User_Standard extends E_User
{
    /**
     * @type int The Date of the last uploaded photo in time() format
     */
    private $last_Upload;

    /**
     * @type int Daily counter of total uploaded photos
     */
    private $up_Count;


    /**
     * Instantiates a Standard User object.
     * This user has limited uploads and no rights to set reserved photos
     *
     * @param string $username This user's username
     * @param string $password This user's password
     * @param string $email This user's email
     * @param int $up_Count The number of uploads done. Leave empty to set it to 0
     * @param int $last_up The timestamp of last upload. Leave empty to set it to NOW
     */
    public function __construct($username, $password, $email, $up_Count='', $last_up = '')
    {
        parent::__construct($username, $password, $email);
        parent::set_Role(Roles::STANDARD);

        $this->set_up_Count($up_Count);
        $this->set_Last_Upload($last_up);
    }


    /**
     * Sets the last upload date
     * @param int $date The timestamp of this user's last upload
     */
    private function set_Last_Upload($date = '')
    {
        if ($date==='' || $date<0)
        {
            $date = time();
        }
        $this->last_Upload = $date;
    }


    /**
     * Gets the last upload date in timestamp format
     * @return int The timestamp of this user's last upload
     */
    public function get_Last_Upload()
    {
        return $this->last_Upload;
    }


    /**
     * Returns the total of Uploads done today.
     * Resets the Upload count to 0 if the date of the last upload is different from "today"'s date.
     * @return int The number of uploads done today by this user
     */
    public function get_up_Count()
    {
        if (date('d-m-y', $this->last_Upload) !== date('d-m-y')) //date(...) is a STRING!! Can NOT use < or >
        {
            $this->set_Last_Upload();
            $this->reset_Up_Count();
        }
        return $this->up_Count;
    }


    /**
     * Sets the number of uploads done by the user
     * @param int $upc The number of uploads done already
     */
    public function set_up_Count($upc='')
    {
        if($upc==='' || $upc<0)
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
     * Checks whether the user can still upload
     * @return bool Returns TRUE if the user can upload at least 1 more photo
     */
    public function can_Upload()
    {
        if ($this->get_up_Count <= UPLOAD_STD_LIMIT) //STD User with less or equal to 10 uploads done today
        {
            return TRUE;
        }
        return FALSE;
    }
}