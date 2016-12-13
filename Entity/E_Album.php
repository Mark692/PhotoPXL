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
    private $categories;
    private $create_date;



    /**
     *
     * @param string $title
     * @param        $photo
     * @param string $desc
     */
    public function __construct($title, $photo, $desc='')
    {
        $this->title = $title;
        $this->description = $desc;
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

}
