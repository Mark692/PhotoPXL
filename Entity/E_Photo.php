<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

class E_Photo {

    private $title;
    private $description;
    private $upload_date;

    /**
     * A "PRO (or higher) User" may decide to declare a photo as Reserved to make it unlisted
     * and visible to himself only. Default = FALSE, meaning it's visible to any user
     * @var bool
     */
    private $reserved = FALSE;



    /**
     * TODO: ADD THIS ATTRIBUTE AND METHODS TO ENABLE THE "LIKE-SYSTEM"
     * private $like; //@type int
     *
     * public function get_like() {
     *      return $this->like;
     * }
     *
     * public function add_like() {
     *      $this->like = $this->like +1;
     * }
     *
     * public function remove_like() {
     *      $this->like = $this->like -1;
     * }
     */


    /**
     *
     * @param string $title
     * @param string $desc
     * @param string $up_date
     * @param bool $reserved
     */
    public function __construct($title, $desc, $up_date, $reserved = FALSE)
    {
        $this->title = $title;
        $this->description = $$desc;
        $this->upload_date = $up_date;
        $this->reserved = $reserved;
    }


    /**
     * Sets a new title for the Photo
     * @param string
     */
    public function set_title($new_title)
    {
        $this->title = $new_title;
    }


    /**
     * Retrieves the title of the Photo
     * @return string
     */
    public function get_title()
    {
        return $this->title;
    }


    /**
     * Sets a new description for the Photo
     * @param string
     */
    public function set_description($new_description)
    {
        $this->description = $new_description;
    }


    /**
     * Retrieves the description of the Photo
     * @return string
     */
    public function get_description()
    {
        return $this->description;
    }


    /**
     * Sets the date for the Photo
     * @param string
     */
    public function set_upload_date()
    {
        $this->upload_date = date("dmy");
    }


    /**
     * Retrieves the upload date of the Photo
     * @return string
     */
    public function get_upload_date()
    {
        return $this->upload_date;
    }


    /**
     * Sets a new visibility for the Photo
     * @param bool
     */
    public function set_reserved(bool $reserved)
    {
        $this->reserved = $reserved;
    }


    /**
     * Retrieves the visibility of the Photo
     * @return string
     */
    public function get_reserved()
    {
        return $this->reserved;
    }

}
