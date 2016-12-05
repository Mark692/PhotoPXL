<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Control;

/*
 * Questa classe si occupa di svolgere operazioni base con le flag
 */
class C_Bitsets {
    
    private $set;
    
    public function __construct($bits = 0) {
    
        $this->set = $bits;
    }
    
    
    /* 
     * Controlla che siano settati I BITS in $flag
     * @return boolean
     */
    public function controlla($flag) {
        
        return ($this->set & $flag) == $flag;
    }
    
    
    /*
     * Imposta un permesso con il BitwiseOR
     * @return boolean
     */
    public function attiva($flags) {
        
        $this->set = $this->set | $flags;
    }
    
    
    /*
     * Setta a 0 i bit di $set nelle stesse posizioni in cui sono settati in $bits
     */
    public function disattiva($bits) {
        
        $this->set = $this->set & (~$bits);
    }
    
}