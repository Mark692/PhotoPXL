<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

/*
 * This class works on User Roles
 */
class E_Role {  //CAN DELETE THIS CLASS: IMPLEMENTED IN E_USER ALREADY!!
    
    private $role;
    
    public function __construct($bits = 0) {
        $this->role = $bits;
    }
    
    
    /* 
     * Controlla che siano settati I BITS in $flag
     * @return boolean
     */
    public function is_on($flag) {
        return ($this->role & $flag) == $flag;
    }
    
    
    /*
     * Imposta un permesso con il BitwiseOR
     * @return boolean
     */
    public function set_on($flags) {
        $this->role = $this->role | $flags;
    }
    
    
    /*
     * Setta a 0 i bit di $set nelle stesse posizioni in cui sono settati in $bits
     */
    public function set_off($bits) {
        $this->role = $this->role & (~$bits);
    }
    
}