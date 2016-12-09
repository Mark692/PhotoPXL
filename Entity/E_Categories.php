<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

class Categories {

    /**
     * Categories array that describes both photos and albums
     */
    const PAESAGGI = 0;
    const RITRATTI = 1;
    const FAUNA = 2;
    const MACRO = 3;
    const BIANCO_NERO = 4;
    const ASTRONOMIA = 5;
    const STREET = 6;
    const NATURA_MORTA = 7;
    const SPORT = 8;

    private $categories;

    //I TRE PORCELLINI

    /**
     * Instantiate an array of categories
     * @param array $cat
     */
    public function __construct(array $cat) {
        $this->categories = $cat;
    }

    /**
     * Changes radically the previous instantiated array of categories
     * @param array $new_cats
     */
    public function set(array $new_cats) {
        $this->categories = $new_cats;
    }

    /**
     * Retrives the categories array
     * @return array
     */
    public function get() {
        return $this->categories;
    }

    //--------------NOT--REALLY--USED--METHODS-------------------------

    /**
     * Adds the string/array of categories to $this->categories
     * @param string or array $to_add
     */
    public function add($to_add) {
        if ($to_add != "" && $to_add != []) {
            array_push($this->categories, $to_add);
        }
    }

    /**
     * Removes the string/array of categories from $this->categories
     * @param string or array $to_del
     */
    public function remove($to_del) {
        if ($to_del != "" && $to_del != []) {
            array_diff($this->categories, $to_del);
        }
    }

}
