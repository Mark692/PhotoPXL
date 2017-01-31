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
    private $is_reserved;
    private $upload_date;
    private $categories = []; //Categorie della foto
    private $like;
    private $comments = [];


    /**
     * Instantiates a Photo object taken from the DB or just uploaded.
     * In case the Photo has been just uploaded use the short-construct in order to set:
     * $up_date = time()
     * $like = 0
     *
     * @param string $id The photo's unique id
     * @param string $title The title given by the user
     * @param string $desc The description given by the user
     * @param bool $reserved Whether the photo is reserved or public
     * @param string $user The uploader username
     * @param array $cat The categories of this photo
     * @param int $like The number of like this photo earned
     * @param int $up_date The date of upload. If just uploaded set it to an empty string or don't use touch this parameter
     */
    public function __construct($id, $title, $desc, $is_reserved, $cat, $like=0, $up_date='')
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $desc;
        $this->setlike($like);
        $this->set_reserved($is_reserved);
        $this->set_cat($cat);
        $this->set_upload_date($up_date);
    }


    /**
     * Sets the Photo privacy as
     * Reserved (if $is_reserved === TRUE):  only certain users will be able to see the photo
     * Public   (if $is_reserved === FALSE): ALL users will be able to see the photo
     * @param bool $is_reserved The new Photo privacy
     */
    public function set_reserved(bool $is_reserved)
    {
        $this->is_reserved = $is_reserved;
    }


    /**
     * Retrieves the visibility of the Photo
     * @return bool Retrieves the visibility of the Photo
     */
    public function get_reserved()
    {
        return $this->is_reserved;
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
    public function set_upload_date($up_date = '')
    {
        if ($up_date==='' || $up_date<0)
        {
            $up_date = time();
        }
        $this->upload_date = $up_date;
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
     * Sets an uploader user for the Photo
     * @param string
     */
    public function set_user($user)
    {
        $this->user = $user;
    }


    /**
     * Retrieves the uploader user
     * @return string
     */
    public function get_user()
    {
        return $this->user;
    }


    /**
     * Sets an array of categories for the Photo
     * @param string or array $cat The array/string of categories to set for the photo
     */
    public function set_cat($cat)
    {
        $this->categories = $cat;
    }


    /**
     * Adds the array of categories to $this->categories, if not already present
     * @param string or array $to_add The array/string of categories to add at the current categories
     */
    public function add_cat($to_add)
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


//AGGIUNGI LE FUNZIONI PER I COMMENTI!!!!
//AGGIUNGI LE FUNZIONI PER I COMMENTI!!!!
//AGGIUNGI LE FUNZIONI PER I COMMENTI!!!!
//AGGIUNGI LE FUNZIONI PER I COMMENTI!!!!
//AGGIUNGI LE FUNZIONI PER I COMMENTI!!!!
//AGGIUNGI LE FUNZIONI PER I COMMENTI!!!!
//AGGIUNGI LE FUNZIONI PER I COMMENTI!!!!
//AGGIUNGI LE FUNZIONI PER I COMMENTI!!!!
//AGGIUNGI LE FUNZIONI PER I COMMENTI!!!!
//AGGIUNGI LE FUNZIONI PER I COMMENTI!!!!
//AGGIUNGI LE FUNZIONI PER I COMMENTI!!!!
//AGGIUNGI LE FUNZIONI PER I COMMENTI!!!!
//AGGIUNGI LE FUNZIONI PER I COMMENTI!!!!
//AGGIUNGI LE FUNZIONI PER I COMMENTI!!!!


    public function add_Comment($comment)
    {
        array_push($this->comments, $comment);
    }


    public function get_Comments()
    {
        return $this->comments;
    }


    public function remove_Comment($comment_ID)
    {
        if(in_array($comment_ID, $this->comments))
        {
            unset($this->comments[$comment_ID]);
        }
        $this->categories = array_values($this->categories); //Ordinates the array without any gaps in between the keys
    }

























}
