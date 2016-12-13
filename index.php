<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once ".".DIRECTORY_SEPARATOR."Includi".DIRECTORY_SEPARATOR."Autoloader.php";
require_once ".".DIRECTORY_SEPARATOR."Includi".DIRECTORY_SEPARATOR."config.inc.php";



global $config;
$tryme = new \Prove\Prove();
$obj = $tryme->rnd_E_User(); //Crea un utente con dati casuali

$futente = new \Foundation\F_User();
var_dump($futente);
echo(nl2br("\r\n"));
echo(nl2br("\r\n"));

//$out = $futente::keyval($obj);
//var_dump($out);
//$futente::set($obj);


var_dump($futente::get_by("BsbR5JG"));







//$avvia = new \View\V_Home();
