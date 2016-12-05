<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

class E_Foto {
    
    public $titolo;
    public $descrizione;
    public $data_upload;
    
    /*
     * Costanti per definire un singolo intero, binario, per definire diverse
     * categorie di foto
     */ 
    const PAESAGGI   = 0x1; // 0000 0001
    const RITRATTI   = 0x2; // 0000 0010
    const VOLTI      = 0x4; // 0000 0100
    const APOCALISSE = 0x8; // 0000 1000
    const ANIMALI    = 0x10;// 0001 0000
    const STORICA    = 0x20;// 0010 0000
    const MARE       = 0x40;// 0100 0000
    const MONTAGNA   = 0x80;// 1000 0000
    
    public $f_flags;
    
    
    
}