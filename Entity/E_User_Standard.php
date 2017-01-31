<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;
use Utilities\Roles;
class E_User_Standard extends E_User_Basic
{
    /**
     * @type int Daily counter of total uploaded photos
     */
    private $up_Count;

    public function __construct($username, $password, $email, $up_Count, $last_up = '')
    {
        parent::__construct($username, $password, $email, $up_Count, $last_up);
        $this->role = Roles::STANDARD;
    }

    /**
     * Returns the total of Uploads done today.
     * Resets the Upload count to 0 if the date of the last upload is different from "today"'s date.
     * @return int
     */
    public function get_up_Count()
    {
        if (date('d-m-y', $this->last_Upload) !== date('d-m-y')) //date(...) is a STRING!! Can NOT use < or >
        {
            $this->set_last_Upload();
            $this->reset_Up_Count();
        }
        return $this->up_Count;
    }


    /**
     * Sets the number of uploads done by the user
     * @param int $upc The number of uploads done already
     */
    public function set_up_Count($upc)
    {
        if($upc<0)
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
     * Enables this user to became a PRO User
     */
    public function become_PRO()
    {
        $this->role = Roles::PRO;
        // foundation goes here
    }


    /**
     * Checks whether the user can still upload
     * @return bool
     */
    public function can_upload()
    {
        if ($this->get_up_Count <= UPLOAD_STD_LIMIT) //STD User with less or equal to 10 uploads done today
        {
            return TRUE;
        }
        return FALSE;
    }
}