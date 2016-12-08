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
     *
    const PAESAGGI;
    const RITRATTI;
    const FAUNA;
    const MACRO;
    const BIANCO_NERO;
    const ASTRONOMIA;
    const STREET;
    const NATURA_MORTA;
    const SPORT;
    */
    private $categories;
    
    
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
    
    
    /**
     * Adds the string/array of categories to $this->categories
     * @param string $s_del
     * @param array $a_del
     */
    public function add(string $s_del="", array $a_del=[]) {
        if($s_del!="") {
            array_push($this->categories, $s_del);
        }
        if($a_del!=[]) {
            array_push($this->categories, $a_del);
        }
    }
    
    
    /**
     * Removes the string/array of categories from $this->categories
     * @param string $s_del
     * @param array $a_del
     */
    public function remove(string $s_del="", array $a_del=[]) {
        if($s_del!="") {
            array_diff($this->categories, $s_del);
        }
        if($a_del!=[]) {
            array_diff($this->categories, $a_del);
        }
    }
    
    
    
}