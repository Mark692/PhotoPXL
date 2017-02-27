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
//$res = \Foundation\F_User::get_LoginInfo("allser");
//print_r($res);
//echo(nl2br("\r\n"));
//if(empty($res))
//{
//    echo("il risultato è EMPTY");
//}
//else
//{
//    echo("No, non è EMPTY. E' ");
//    var_dump($res);
//}

//
//$res = \Foundation\F_User::get_By_Role(8);
//var_dump($res);







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
