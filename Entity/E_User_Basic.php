<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

/**
 * This class defines the attributes of each user
 */
class E_User_Basic extends E_User
{

    private $role;

    /**
     * @type int Daily counter of total uploaded photos
     */
    private $up_Count;

    /**
     * @type int The Date of the last uploaded photo in time() format
     */
    private $last_Upload;


    /**
     * Sets the parameters needed to instantiate a new User
     * @param string $username
     * @param string $password
     * @param string $email
     * @param int $up_Count
     * @param int $last_up
     */
    public function __construct($username, $password, $email, $up_Count, $last_up='')
    {
        parent::__construct($username, $password, $email);

        $this->set_up_Count($up_Count);
        $this->set_last_Upload($last_up);
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
     * Gets the last upload date in seconds
     * @return int
     */
    public function get_last_Upload()
    {
        return $this->last_Upload;
    }


    /**
     * Sets the last upload date
     */
    private function set_last_Upload($date = '')
    {
        if ($date==='' || $date<0)
        {
            $date = time();
        }
        $this->last_Upload = $date;
    }
}