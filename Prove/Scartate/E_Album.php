<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Prove\Scartate;

class ScartataE_Album
{

    /**
     * Sets an array of categories for the Album
     *
     * @param string or array $cat The string/array of category/ies to set for the album
     */
    public function set_Categories($cat=[])
    {
        $this->categories = $cat;
    }


    /**
     * Sets an array of categories for the Album
     *
     * @param string or array $to_add The string/array of category/ies to add at the current array
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
     * Retrives the categories array for this album
     *
     * @return array The list of categories for the Album
     */
    public function get_Categories()
    {
        return $this->categories;
    }


    /**
     * Removes the array of categories from $this->categories if present
     *
     * @param array $to_del The categories to remove from the current array
     */
    public function remove_Cat($to_del)
    {
        foreach((array) $to_del as $val)
        {
            $cat_key = array_search($val, $this->categories); //Key of the value $val (that is $to_del)
            if ($val != '' && $cat_key !== FALSE) //If ($to_del IS in $this->categories)
            {
                unset($this->categories[$cat_key]);
            }
        }
        $this->categories = array_values($this->categories); //Ordinates the array without any gaps in between the keys
    }
}