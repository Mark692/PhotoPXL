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


$CU = new \CaseUse\CU_Photos();
$title = "Foto Bella";
$desc = "questa è la mia foto personale";
$is_reserved = 0;
$cat = array(1, 4, 5, 6);
$path_Photo = ".".DIRECTORY_SEPARATOR."Entity.jpg";
$uploader = "Marco";

$CU->upload_it($title, $desc, $is_reserved, $cat, $path_Photo, $uploader);



