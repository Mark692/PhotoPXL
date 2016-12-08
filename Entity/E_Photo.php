<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

class E_Foto {

    private $title;
    private $description;
    private $upload_date;

    /**
     * A "PRO User" may decide to declare a photo as Reserved to make it unlisted
     * and visible to himself only.
     * @var bool
     */
    private $reserved;

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
    public function __construct($title, $desc, $up_date, $reserved) {
        $this->title = $title;
        $this->description = $$desc;
        $this->upload_date = $up_date;
        $this->reserved = $reserved;
    }

    /**
     * Sets a new title for the Photo
     * @param string
     * @return string
     */
    public function set_title($new_title) {
        return $this->title = $new_title;
    }

    /**
     * Retrieves the title of the Photo
     * @return string
     */
    public function get_title() {
        return $this->title;
    }

    /**
     * Sets a new description for the Photo
     * @param string
     * @return string
     */
    public function set_description($new_description) {
        return $this->description = $new_description;
    }

    /**
     * Retrieves the description of the Photo
     * @return string
     */
    public function get_description() {
        return $this->description;
    }

    /**
     * Sets a new upload date for the Photo
     * @param string
     * @return string
     */
    public function set_upload_date($new_upload_date) {
        return $this->upload_date = $new_upload_date;
    }

    /**
     * Retrieves the upload date of the Photo
     * @return string
     */
    public function get_upload_date() {
        return $this->upload_date;
    }

    /**
     * Sets a new visibility for the Photo
     * @param bool
     * @return string
     */
    public function set_reserved(bool $reserved) {
        return $this->reserved = $reserved;
    }

    /**
     * Retrieves the visibility of the Photo
     * @return string
     */
    public function get_reserved() {
        return $this->reserved;
    }

}
