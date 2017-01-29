<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

class E_Album
{
    private $ID;
    private $title;
    private $description;
    private $categories = [];
    private $create_date;


    /**
     * @param string $title The  title of the album
     * @param string $desc The description of the album
     * @param array $categories The categories array of the album
     * @param int $create_date The creation date of the album
     */
    public function __construct($ID, $title, $desc, $categories, $create_date='')
    {
        $this->set_ID($ID);
        $this->set_title($title);
        $this->set_description($desc);
        $this->set_categories($categories);
        $this->set_date($create_date);
    }


    /**
     * Sets a new title for the Album
     * @param string The album title
     */
    public function set_title($new_title)
    {
        $this->title = $new_title;
    }


    /**
     * Retrieves the title of the Album
     * @return string The album title
     */
    public function get_title()
    {
        return $this->title;
    }


    /**
     * Sets a new description for the Album
     * @param string
     */
    public function set_description($new_description)
    {
        $this->description = $new_description;
    }


    /**
     * Retrieves the description of the Album
     * @return string
     */
    public function get_description()
    {
        return $this->description;
    }


    /**
     * Sets an array of categories for the Album
     * @param string or array $cat The array/string of categories to set for the album
     */
    public function set_cat($cat)
    {
        $this->categories = $cat;
    }


    /**
     * Sets an array of categories for the Album
     * To remove the current category use an empty string as parameter
     * @param string or array $to_add The array/string of categories to add at the current array
     */
    public function add_cat($to_add)
    {
        foreach((array) $to_add as $val) //In case $to_add is a string it would be casted to array
        {
            if ($val != '' && !in_array($val, $this->categories)) //If ($to_add IS NOT in $this->categories)
            {
                array_push($this->categories, $val);
                //Si può aggiungere un return TRUE qui
            }
            //ed un return FALSE qui per gestire l'esito della set_cat
        }
    }


    /**
     * Retrives the categories array
     * @return array
     */
    public function get_cat()
    {
        return (array) $this->categories;
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


    /**
     * Sets a creation date for the Album
     * @param int The timestamp of the Album's creation
     */
    public function set_date($date='')
    {
        if ($date == '')
        {
            $this->create_date = time();
        }
        else
        {
            $this->create_date = $date;
        }
    }


    /**
     * Retrieves the creation date of the Album
     * @return int The timestamp of the Album's creation
     */
    public function get_date()
    {
        return $this->create_date;
    }


    /**
     * Sets the ID for the album. It is the Database ID, so it should be used in __construct() only
     * @param int $ID The album ID. Rethrived from the Database.
     */
    public function set_ID($ID)
    {
        $this->ID = $ID;
    }
    /**
     * @return int The Database ID of the album
     */
    public function get_ID()
    {
        return $this->ID;
    }


}
