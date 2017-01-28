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

//---Prova per E_Photo
$p_tryme = new \Prove\TE_Photo();
$p_tryme->T_pconstr();








//---Prova per E_User()
//$e_tryme = new \Prove\TE_User();
//$e_tryme->T_uconstr(); //Stampa tre utenti con dati casuali
//$e_tryme->T_PromoteDemote();
//$e_tryme->T_SetGet();
//$e_tryme->T_Data();


//---Prova per U_Nonce()
//$n_tryme = new \Prove\TU_Nonce();
//$n_tryme->T_check();






echo(nl2br("\r\n"));





//-----------------------------FINE-PROVE--------------------------//

//$avvia = new \View\V_Home();
