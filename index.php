<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once ".".DIRECTORY_SEPARATOR."Includi".DIRECTORY_SEPARATOR."Autoloader.php";
require_once ".".DIRECTORY_SEPARATOR."Includi".DIRECTORY_SEPARATOR."config.inc.php";

global $config;


//------------------------------PROVE------------------------------//
$tryme = new \Prove\TE_User();
//$tryme->T_uconstr(); //Stampa due utente con dati casuali
//$tryme->T_PromoteDemote(); //Stampa due utente con dati casuali
//$tryme->T_SetGet(); //Stampa due utente con dati casuali
$tryme->T_Data(); //Stampa due utente con dati casuali


//var_dump($arr);
//echo(nl2br("\r\n"));

echo(nl2br("\r\n"));






//$avvia = new \View\V_Home();
