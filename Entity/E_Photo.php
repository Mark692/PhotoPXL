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
    private $categories; //Categorie della foto
    private $likes;
    private $upload_date;


    /**
     * Instantiates a Photo object taken from the DB or just uploaded.
     * In case the Photo has just been uploaded use the short-construct in order to set:
     * - $likes = 0
     * - $up_date = time()
     *
     * @param string $title The title given by the user
     * @param string $desc The description given by the user
     * @param bool $is_reserved Whether the photo is reserved or public
     * @param array $cat The categories of this photo
     * @param array $likes The list of users that liked the photo
     * @param int $up_Date The date of upload. Leave it empty to set it to NOW
     */
    public function __construct($title, $desc = '', $is_reserved = FALSE, $cat = [], $likes = [], $up_Date = 0)
    {
        if($this->check_Title($title) === FALSE)
        {
            throw new \Exceptions\input_texts(2, $title);
        }
        $this->set_Title($title);

        if($desc !== '' && $this->check_Description($desc) === FALSE)
        {
            throw new \Exceptions\input_texts(3, $desc);
        }
        $this->set_Description($desc);
        $this->set_Reserved($is_reserved);
        $this->set_Categories($cat);
        $this->set_Likes($likes);
        $this->set_Upload_Date($up_Date);
    }


    /**
     * Sets the ID for the photo. It is the Database ID, so it should be used in __construct() only
     *
     * @param int $ID The photo ID. Rethrived from the Database.
     */
    public function set_ID($ID)
    {
        $this->ID = $ID;
    }


    /**
     * Returns the ID of this photo
     *
     * @return int The Database ID of the photo
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
        $this->is_reserved = $is_reserved;
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
        $this->title = $new_title;
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
     * Checks whether the title is a valid entry
     *
     * @param string $title The photo title input
     * @return bool Whether the title has only a-zA-Z0-9, the $allowed chars and a length of [3, 30] chars
     */
    private function check_Title($title)
    {
        if(strlen($title)>=MIN_TITLE_CHARS
                && strlen($title)<=MAX_TITLE_CHARS)
        {
            $allowed = array('\'', '-', '_', '.', ' ', '!', '?'); //Allows these chars inside an album title
            if(ctype_alnum(str_replace($allowed, '', $title))) //Removes the allowed chars and checks whether the string is Alphanumeric
            {
                return TRUE;
            }
        }
        return FALSE;
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
     * Used to check whether the input description uses UTF-8 chars
     *
     * @param string $desc The description to evaluate
     * @return bool Whether the description uses UTF-8 chars only and has less than 500 chars
     */
    private function check_Description($desc)
    {
        if(strlen($desc)<=MAX_DESCRIPTION_CHARS)
        {
            return mb_check_encoding($desc, 'UTF-8');
        }
        return FALSE;
    }


    /**
     * Sets the date in Timestamp format of the Photo's upload
     *
     * @param int The timestamp of uploading
     */
    public function set_Upload_Date($up_date = 0)
    {
        if($up_date <= 0)
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
     * Sets an array of categories for the Photo
     *
     * @param array $cat The array of categories to set for the photo
     */
    public function set_Categories($cat)
    {
        $this->categories = $cat;
    }


    /**
     * Retrives the categories array
     *
     * @return array The array of this photo's categories
     */
    public function get_Categories()
    {
        return $this->categories;
    }


    /**
     * Sets the number of likes received
     *
     * @param array $total_likes The number of likes received on this photo
     */
    public function set_Likes($total_likes)
    {
        $this->likes = $total_likes;
    }


    /**
     * Retrieves the number of likes received
     *
     * @return array The number of likes received
     */
    public function get_Likes()
    {
        return $this->likes;
    }


    /**
     * Sets the number of comments for this photo
     *
     * @param int $comments The number of comments for this photo
     */
    public function set_Comments($comments)
    {
        $this->total_comments = $comments;
    }


    /**
     * Retrieves the number of comments for this photo
     *
     * @return int The number of comments for this photo
     */
    public function get_Comments()
    {
        return $this->total_comments;
    }


}