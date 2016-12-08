<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

class Categories {
    
    /**
     * Categories array to describe both photos and albums
     */ 
    private $categories = array(
        0  => "Paesaggi",
        1  => "Ritratti",
        2  => "Volti",
        3  => "Animali",
        4  => "Gatti",
        5  => "Cani",
        6  => "Storica",
        7  => "Mare",
        8  => "Montagna",
        9  => "Bianco e Nero",
        10 => "Seppia"
        );
    
    
    /*
     * Adds a category to the list
     * @param string
     */
    public function set_categories(array $cat) {
        array_push($this->categories, $cat);
    }
    
    
    /**
     * Gets the categories array
     * @return array
     */
    public function get_categories() {
        return $this->categories;
    }
    
    
    
    
    
    
    
    
    
}