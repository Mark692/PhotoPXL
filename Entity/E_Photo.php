<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

/**
 * This class allows to set detailed informations about photos
 */
class E_Photo
{
    private $ID;
    private $title;
    private $description;
    private $is_reserved;
    private $upload_date;
    private $categories = []; //Categorie della foto
    private $likes;
    private $comments = [];


    /**
     * Instantiates a Photo object taken from the DB or just uploaded.
     * In case the Photo has just been uploaded use the short-construct in order to set:
     * - $likes = 0
     * - $up_date = time()
     *
     * @param string $title The title given by the user
     * @param string $desc The description given by the user
     * @param bool $is_Reserved Whether the photo is reserved or public
     * @param array $cat The categories of this photo
     * @param int $likes The number of like this photo earned. Leave it empty to set it to 0
     * @param int $up_Date The date of upload. Leave it empty to set it to NOW
     */
    public function __construct($title, $desc, $is_Reserved, $cat, $likes=0, $up_Date='')
    {
        $this->set_Title($title);
        $this->set_Description($desc);
        $this->set_Likes($likes);
        $this->set_Reserved($is_Reserved);
        $this->set_Categories($cat);
        $this->set_Upload_Date($up_Date);
    }


    /**
     * Sets the ID for the photo. It is the Database ID, so it should be used in __construct() only
     *
     * @param string $ID The photo ID. Rethrived from the Database.
     */
    public function set_ID($ID)
    {
        $this->ID = $ID;
    }


    /**
     * Returns the ID of this photo
     *
     * @return string The Database ID of the photo
     */
    public function get_ID()
    {
        return $this->ID;
    }


    /**
     * Sets the Photo privacy as
     * - Reserved (TRUE): only certain users will be able to see the photo
     * - Public  (FALSE): ALL users will be able to see the photo
     *
     * @param bool $is_reserved The new Photo privacy
     */
    public function set_Reserved($is_reserved)
    {
        if(is_bool($is_reserved))
        {
            $this->is_reserved = $is_reserved;
        }
    }


    /**
     * Retrieves the visibility of the Photo
     *
     * @return bool Retrieves the visibility of the Photo
     */
    public function get_Reserved()
    {
        return $this->is_reserved;
    }


    /**
     * Sets a new title for the photo
     *
     * @param string $new_title The photo title
     */
    public function set_Title($new_title)
    {
        if($this->title_isValid($new_title))
        {
            $this->title = $new_title;
        }
    }


    /**
     * Checks whether the title is a valid entry
     *
     * @param string $title The photo title input
     * @return bool Returns TRUE if the title has only a-zA-z0-9-_. and spaces chars
     */
    private function title_isValid($title)
    {
        $allowed = array('\'', '-', '_', '.', ' ', '!', '?'); //Allows these chars inside a photo title
        if(ctype_alnum(str_replace($allowed, '', $title))) //Removes the allowed chars and checks whether the string is Alphanumeric
        {
            return TRUE;
        }
        throw new \Exceptions\invalid_Text(2, $title);
    }


    /**
     * Retrieves the title of the Photo
     *
     * @return string The photo's title
     */
    public function get_Title()
    {
        return $this->title;
    }


    /**
     * Sets a new description for the Photo
     *
     * @param string The description for the photo
     */
    public function set_Description($new_description)
    {
        $this->description = $new_description;
    }


    /**
     * Retrieves the description of the Photo
     *
     * @return string This photo's description
     */
    public function get_Description()
    {
        return $this->description;
    }


    /**
     * Sets the date in Timestamp format of the Photo's upload
     *
     * @param int The timestamp of uploading
     */
    public function set_Upload_Date($up_date = '')
    {
        if ($up_date==='' || $up_date<0)
        {
            $up_date = time();
        }
        $this->upload_date = $up_date;
    }


    /**
     * Retrieves the timestamp of this Photo's upload
     *
     * @return int The timestamp of this Photo's upload
     */
    public function get_Upload_Date()
    {
        return $this->upload_date;
    }


    /**
     * Sets the likes the Photo received
     *
     * @param int $number The number of likes  the Photo received
     */
    public function set_Likes($number)
    {
        $this->likes = $number;
    }


    /**
     * Retrieves the likes the Photo received
     * @return int The likes the Photo received
     */
    public function get_Likes()
    {
        return $this->likes;
    }


    /**
     * Adds a like to the current Photo
     */
    public function add_Like()
    {
        $this->likes = $this->likes +1;
    }


    /**
     * Removes a like from the current Photo
     */
    public function remove_Like()
    {
        $this->likes = $this->likes -1;
    }


    /**
     * Sets a string/array of category/ies for the Photo
     * @param string or array $cat The string/array of category/ies to set for the photo
     */
    public function set_Categories($cat)
    {
        $this->categories = $cat;
    }


    /**
     * Adds the string/array of category/ies to $this->categories, if not already present
     * @param string or array $to_add The string/array of category/ies to add at the current categories
     */
    public function add_Cat($to_add)
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
     * @return array The array of this photo's categories
     */
    public function get_Cat()
    {
        return $this->categories;
    }


    /**
     * Removes the string/array of category/ies from $this->categories if present
     * @param string or array $to_del
     */
    public function remove_Cat($to_del)
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

    //SPOSTA QUESTE IN CONTROL? FOUNDATION? ENTRAMBE?
    //SPOSTA QUESTE IN CONTROL? FOUNDATION? ENTRAMBE?
    //SPOSTA QUESTE IN CONTROL? FOUNDATION? ENTRAMBE?
    //SPOSTA QUESTE IN CONTROL? FOUNDATION? ENTRAMBE?
    //SPOSTA QUESTE IN CONTROL? FOUNDATION? ENTRAMBE?
    //SPOSTA QUESTE IN CONTROL? FOUNDATION? ENTRAMBE?
    //SPOSTA QUESTE IN CONTROL? FOUNDATION? ENTRAMBE?
    //SPOSTA QUESTE IN CONTROL? FOUNDATION? ENTRAMBE?
    //SPOSTA QUESTE IN CONTROL? FOUNDATION? ENTRAMBE?
    //SPOSTA QUESTE IN CONTROL? FOUNDATION? ENTRAMBE?
    //SPOSTA QUESTE IN CONTROL? FOUNDATION? ENTRAMBE?
    //SPOSTA QUESTE IN CONTROL? FOUNDATION? ENTRAMBE?

























}
