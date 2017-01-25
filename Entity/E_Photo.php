<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

class E_Photo
{

    private $id;
    private $title;
    private $description;
    private $upload_date;
    private $user; //L'utente che ne fa l'upload
    private $categories; //Categorie della foto

    /**
     * A "PRO (or higher) User" may decide to declare a photo as Reserved to make it unlisted
     * and visible to himself only. Default = FALSE, meaning it's visible to any user
     * @var bool
     */
    private $reserved = FALSE;

    private $like = 0; //@type int


    /**
     *
     * @param string $id
     * @param string $title
     * @param string $desc
     * @param int $like
     * @param bool $reserved
     * @param string $user
     * @param array $cat
     * @param int $up_date
     */
    public function __construct($id, $title, $desc, $like, $reserved, $user, $cat, $up_date='')
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $desc;
        $this->like = $like;
        $this->reserved = $reserved;
        $this->user = $user;
        $this->categories = $cat;
        if ($up_date == '')
        {
            $this->set_upload_date(time());
        }
        else {$this->upload_date = $up_date;}
    }


    /**
     * Sets a new id for the Photo
     * @param string
     */
    public function set_id($new_id)
    {
        $this->id = $new_id;
    }


    /**
     * Retrieves the id of the Photo
     * @return string
     */
    public function get_id()
    {
        return $this->id;
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
    public function set_upload_date($date)
    {
        $this->upload_date = $date;
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
     * Sets the like number for the Photo
     * @param int
     */
    public function set_like($number)
    {
        $this->like = $number;
    }


    /**
     * Retrieves the like number of the Photo
     * @return int
     */
    public function get_like()
    {
        return $this->like;
    }


    /**
     * Adds a like to the current Photo
     */
    public function add_like()
    {
        $this->like = $this->like +1;
    }


    /**
     * Removes a like for the current Photo
     */
    public function remove_like()
    {
        $this->like = $this->like -1;
    }


    /**
     * Sets a new visibility for the Photo
     * @param bool
     */
    public function set_reserved($reserved)
    {
        if (is_bool($reserved))
        {
            $this->reserved = $reserved;
        }
    }


    /**
     * Retrieves the visibility of the Photo
     * @return bool
     */
    public function get_reserved()
    {
        return $this->reserved;
    }


    /**
     * Sets an uploader user for the Photo
     * @param string
     */
    public function set_user($user)
    {
        $this->reserved = $user;
    }


    /**
     * Retrieves the uploader user
     * @return bool
     */
    public function get_user()
    {
        return $this->user;
    }


    /**
     * Adds the array of categories to $this->categories, if not already present
     * @param string or array $to_add
     */
    public function set_cat($to_add)
    {
        foreach((array) $to_add as $val) //In case $to_add is a string it would be casted to array
        {
            if ($val != '' && !in_array($val, $this->categories)) //If ($to_add IS NOT in $this->categories)
            {
                array_push($this->categories, $val);
            }
        }
    }


    /**
     * Retrives the categories array
     * @return array
     */
    public function get_cat()
    {
        return $this->categories;
    }


    /**
     * Removes the array of categories from $this->categories if present
     * @param string or array $to_del
     */
    public function remove_cat($to_del)
    {
        foreach((array) $to_del as $val)
        {
            $cat_key = array_search($val, $this->categories); //Key of the value $to_del
            if ($val != '' && $cat_key !== FALSE) //If ($to_del IS in $this->categories)
            {
                unset($this->categories[$cat_key]);
            }
        }
        $this->categories = array_values($this->categories); //Ordinates the array without any gaps in between the keys
    }




























}
