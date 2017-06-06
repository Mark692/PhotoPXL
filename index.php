<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Include Smarty
require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'libs'.DIRECTORY_SEPARATOR.'Smarty.class.php';

//Include autoloader and other functionalities
$path = ".".DIRECTORY_SEPARATOR."Utilities".DIRECTORY_SEPARATOR;
require_once $path."my_Autoloader.php";
require_once $path."config.inc.php";
require_once $path."U_Nonce.php";


//*
$test_it = new \Utilities\installer();
//$test_it->set_DB_ConnectionParameters(); //Uncomment this to enable connection
//parameters with both: mine and standard ones (no pass, no user)

//NOTA: QUESTA FUNZIONE CERCHERA' DI CREARE E POPOLARE IL DATABASE "my_photopxl"
//$test_it->DB_FirstInstallation();

//Prove funzioni
//$test_it->try_Functions();

