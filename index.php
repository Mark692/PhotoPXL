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


$cu = new \CaseUse\CU_Albums();
$owner = "Marco";
$title = "Il mio secondo album";
$desc = "Questo invece ha una descrizione";
$cat = array(3, 3, 5, 6, 5, 3, 7);
$creation_date = 2;
//$cu->upload_it($owner, $title, $desc, $cat, $creation_date);
