<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Data una classe non istanziata e non definita nello script corrente, 'richiedi'
 * si occupa di trovare il path di tale classe
 * 
 * @return void
 */
function mio_autoloader($nome_classe) {
  
    //Autoloader - Prova
    $nome_classe = str_replace("\\", DIRECTORY_SEPARATOR, $nome_classe);
    $percorso1 = $nome_classe . '.php';
    require_once ($percorso1);
    
    //Autoloader - Corretto e funzionante
    //$percorso = "."  . DIRECTORY_SEPARATOR . $nome_classe . ".php";
    //require_once ($percorso); 
}

spl_autoload_register('mio_autoloader');