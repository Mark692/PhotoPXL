<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

/**
 * This class is to be used to edit the categories available for all photos and
 * albums
 */
class E_Categories
{

    /**
     * Categories array that describes both photos and albums
     */
    private $categories = []; //Check the global $config array for the Categories also


    /**
     * Instantiates an array of categories
     * @param array $cat
     */
    public function __construct()
    {
        global $config;
        $this->categories = $config['categories'];
    }


    /**
     * Sets a NEW array of categories
     * @param array $new_cats
     */
    public function set(array $new_cats)
    {
        $this->categories = $new_cats;
    }


    /**
     * Retrives the categories array
     * @return array
     */
    public function get()
    {
        return $this->categories;
    }


    /**
     * Adds the array of categories to $this->categories if not already present
     * @param string or array $to_add
     */
    public function add($to_add)
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
     * Removes the array of categories from $this->categories if present
     * @param string or array $to_del
     */
    public function remove($to_del)
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
