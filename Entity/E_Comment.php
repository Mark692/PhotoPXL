<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

class E_Comment {

    private $text = '';


    
    /**
     *
     * @param string $text
     */
    public function __construct($text)
    {
        $this->text = $text;
    }


    /**
     * Sets a new text
     * @param string
     */
    public function set_text($new_text)
    {
        $this->text = $new_text;
    }


    /**
     * Retrieves the text
     * @return string
     */
    public function get_text()
    {
        return $this->text;
    }

}
