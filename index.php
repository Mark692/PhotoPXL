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
$title = "Modificato";
$desc = "Anche questa è modificata";
$is_reserved = '';
$cat = array(1, 2, 4, 5, 6, 7);
$path_Photo = ".".DIRECTORY_SEPARATOR."Entity.jpg";
$uploader = "Marco";

$ID = 39;
//$CU->upload_it($title, $desc, $is_reserved, $cat, $path_Photo, $uploader);
//$CU->update_Details($ID, $title, $desc, $is_reserved, $cat);

$user_Watching = "ProvaUpload";
$user_Role = 4;
$page_toView = 1;
$order_DESC = TRUE;
//$CU->get_Thumbs_fromUser($uploader, $user_Watching, $user_Role, $page_toView, $order_DESC);

$id = 15;
$CU->get_Fullsize($id, $user_Watching, $user_Role);


