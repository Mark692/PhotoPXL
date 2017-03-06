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


$t = new \P\user();
$t->UPDATE_PROFILE();











//$avvia = new \View\V_Home();
//// prove federico
//global $config;
//$array_foto = [];
//for($i=1; $i<=16; $i++)
//{
//    array_push($array_foto, "templates/main/template/img/NoPhoto.jpg");
//
//}
//$avvia->assign('username',"UsernameLoggato");
//$avvia->assign('thumbnail',array_chunk($array_foto, PHOTOS_PER_ROW));
//$avvia->display('home_default.tpl');

echo(nl2br("\r\n"));
echo(nl2br("\r\n"));
echo(nl2br("\r\n"));
