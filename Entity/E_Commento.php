<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


namespace Entity;

class ECommento {
    
    public $testo;
    
    public function __construct($username, $testo) {
        $this->username = $username;
        $this->testo = $testo;
    }
}