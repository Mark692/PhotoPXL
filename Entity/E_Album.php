<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

class E_Album
{

    private $title;
    private $description;
    private $photo;
    private $category;
    private $create_date;



    /**
     *
     * @param string $title
     * @param string $desc
     * @param array $photo the id list of all photos included in the album
     * @param array $category the SINGLE category of the album
     * @param int $create_date
     */
    public function __construct($title, $desc, $photo, $category, $create_date)
    {
        $this->title = $title;
        $this->description = $desc;
        $this->photo = $photo;
        $this->categories = $category;
        $this->set_date($create_date);
    }


    /**
     * Sets a new title for the Album
     * @param string
     */
    public function set_title($new_title)
    {
        $this->title = $new_title;
    }


    /**
     * Retrieves the title of the Album
     * @return string
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

////////////////////////////////////////////////////////////////////////////////
    /**
     * Sets a photo for the Album
     * @param string  <-------WAT. Controlla come aggiungere le foto
     */
    public function set_photo($photo)
    {
        $this->photo = $photo;
    }


    /**
     * Retrieves the photos of the Album
     * @return string  <-------WAT. Controlla come aggiungere le foto
     */
    public function get_photo()
    {
        return $this->photo;
    }
////////////////////////////////////////////////////////////////////////////////

    /**
     * Sets a category for the Album
     * @param string
     */
    public function set_category($category)
    {
        $this->category = $category;
    }


    /**
     * Retrieves the category of the Album
     * @return string
     */
    public function get_category()
    {
        return $this->category;
    }


    /**
     * Sets a creation date for the Album
     * @param string
     */
    public function set_date($date='')
    {
        if ($date == '')
        {
            $this->create_date = time();
        }
        else {$this->create_date = $date;}
    }


    /**
     * Retrieves the creation date of the Album
     * @return string
     */
    public function get_date()
    {
        return $this->create_date;
    }



}
