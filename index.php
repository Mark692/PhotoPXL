<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$path = ".".DIRECTORY_SEPARATOR."Utilities".DIRECTORY_SEPARATOR;
require_once $path."Autoloader.php";
require_once $path."config.inc.php";
require_once $path."U_Nonce.php";


//------------------------------PROVE------------------------------//
//phpinfo();
//$bob = new \Entity\E_Photo_Blob();
//$percorso = ".".DIRECTORY_SEPARATOR."zzzImmagini".DIRECTORY_SEPARATOR."Bungo".DIRECTORY_SEPARATOR."ccc.png";
//$bob->on_Upload($percorso);
//
//echo '<img src="data:image/png;base64,'.base64_encode( $bob->get_Thumbnail() ).'"/>';


$t = new \P\photo();
$t->MOVE_TO();

echo(nl2br("\r\n"));
echo(nl2br("\r\n"));
echo(nl2br("\r\n"));
