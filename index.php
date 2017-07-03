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


$id = 1;
$username = "Fede";
$role = \Entity\E_User::get_DB_Role($username);
$DB_album= \Entity\E_Album::get_By_ID($id);
$array_photo= \Entity\E_Photo::get_By_Album($id, $username, $role);
\View\V_Album::album($DB_album, $array_photo, $username);




