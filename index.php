<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$path = ".".DIRECTORY_SEPARATOR."Utilities".DIRECTORY_SEPARATOR;
require_once $path."Autoloader.php";
require_once $path."config.inc.php";



//------------------------------PROVE------------------------------//
global $config;

//---Prova per E_User()
//$tryme = new \Prove\TE_User();
//$tryme->T_uconstr(); //Stampa due utenti con dati casuali
//$tryme->T_PromoteDemote();
//$tryme->T_SetGet();
//$tryme->T_Data();


//---Prova per U_Nonce()
$n_tryme = new \Prove\TU_Nonce();
$n_tryme->T_check();






echo(nl2br("\r\n"));





//-----------------------------FINE-PROVE--------------------------//

//$avvia = new \View\V_Home();
