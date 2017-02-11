<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

/**
 * This class allows the creation of photo albums.
 */
class E_Album
{
    private $ID;
    private $title;
    private $description;
    private $categories = [];
    private $creation_date;


    /**
     * Instantiates an Album object taken from the DB or just uploaded.
     * In case the Album has just been created use the short-construct in order
     * to set the $up_date to NOW automatically
     *
     * @param string $title The  title of the album
     * @param string $desc The description of the album
     * @param array $categories The categories array of the album
     * @param int $creation_date The creation date of the album
     */
    public function __construct($title, $desc, $categories=[], $creation_date='')
    {
        $this->set_Title($title);
        $this->set_Description($desc);
        $this->set_Categories($categories);
        $this->set_Creation_Date($creation_date);
    }


    /**
     * Sets the ID for the album. It is the Database ID, so it should be used in __construct() only
     *
     * @param int $ID The album ID. Rethrived from the Database.
     */
    public function set_ID($ID)
    {
        $this->ID = $ID;
    }


    /**
     * Returns the ID of this album
     *
     * @return int The Database ID of the album
     */
    public function get_ID()
    {
        return $this->ID;
    }


    /**
     * Sets a new title for the Album
     *
     * @param string $new_title The album title
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
     * @param string $title The title input
     * @throws \Exceptions\input_texts Whether the title contains invalid chars
     * @return bool Returns TRUE if the title has only a-zA-z0-9-_. and spaces chars
     */
    private function title_isValid($title)
    {
        $allowed = array('\'', '-', '_', '.', ' ', '!', '?'); //Allows these chars inside an album title
        if(ctype_alnum(str_replace($allowed, '', $title))) //Removes the allowed chars and checks whether the string is Alphanumeric
        {
            return TRUE;
        }
        throw new \Exceptions\input_texts(2, $title);
    }


    /**
     * Retrieves the title of the Album
     *
     * @return string The album title
     */
    public function get_Title()
    {
        return $this->title;
    }


    /**
     * Sets a new description for the Album
     *
     * @param string $new_description Sets a new description for this album
     */
    public function set_Description($new_description)
    {
        $this->description = $new_description;
    }


    /**
     * Retrieves the description of the Album
     *
     * @return string This album's description
     */
    public function get_Description()
    {
        return $this->description;
    }


    /**
     * Sets an array of categories for the Album
     *
     * @param array $cat The array of categories to set for the album
     */
    public function set_Categories($cat=[])
    {
        $this->categories = $cat;
    }


    /**
     * Retrives the categories array for this album
     *
     * @return array The list of categories for the Album
     */
    public function get_Categories()
    {
        return $this->categories;
    }


    /**
     * Sets a creation date for the Album
     *
     * @param int $date The timestamp of the Album's creation
     */
    private function set_Creation_Date($date='')
    {
        if ($date==='' || $date<=0)
        {
            $this->creation_date = time();
        }
        else
        {
            $this->creation_date = $date;
        }
    }


    /**
     * Retrieves the Timestamp of album's creation date
     *
     * @return int The timestamp of the Album's creation
     */
    public function get_Creation_Date()
    {
        return $this->creation_date;
    }
}
