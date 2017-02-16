<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$path = ".".DIRECTORY_SEPARATOR."Utilities".DIRECTORY_SEPARATOR;
require_once $path."Autoloader.php";
require_once $path."config.inc.php";
require_once $path."U_Nonce.php"; //SISTEMA QUESTE FUNZIONI IN UNA CLASSE COMPETENTE




//------------------------------PROVE------------------------------//
global $config;

$test = new \Prove\TE_User();
$test->try_it();


echo(nl2br("\r\n"));




//$avvia = new \View\V_Basic();
//$avvia->display('prova');
//$array_foto = [];
//for($i=1; $i<=16; $i++)
//{
//    array_push($array_foto, $i);
//
//}
//
//echo("array_foto: ".nl2br("\r\n"));
//print_r($array_foto);
//
//echo(nl2br("\r\n"));
//echo(nl2br("\r\n"));
//echo(nl2br("\r\n"));
//echo(nl2br("\r\n"));
//echo(nl2br("\r\n"));
//
//$a=array_chunk($array_foto, 6);
//echo("array_chunk: ".nl2br("\r\n"));
//print_r($a[2]);
//
//
//
//
//
//$avvia->assign('abba',array_chunk($array_foto, PHOTOS_PER_ROW));
//
//$avvia->display('prova.tpl');






//-----------------------------FINE-PROVE--------------------------//

//$avvia = new \View\V_Home();
