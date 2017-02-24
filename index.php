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
//echo(nl2br("\r\n"));
//$pd = new \Entity\E_Photo_Blob();
//$percorso = ".".DIRECTORY_SEPARATOR."TTGL.jpg";
//$pd->generateThumbnail($percorso);
//$zeroResult = \Foundation\F_Comment::get_By_Photo("99");
//echo("Var Dump: ");
//var_dump($zeroResult);
//echo(nl2br("\r\n"));
//echo(nl2br("\r\n"));
//echo("Count: ".count($zeroResult));
//echo(nl2br("\r\n"));
//echo(nl2br("\r\n"));
//if($zeroResult===[])
//{
//    echo("ZeroResult è === []");
//}
//elseif($zeroResult!==[])
//{
//    echo("ZeroResult è !== [] :(");
//}
//else
//{
//    echo("Boh, non so che è sta roba");
//}
//echo(nl2br("\r\n"));
//echo(nl2br("\r\n"));

phpinfo();



//-----------------------------FINE-PROVE--------------------------//

$avvia = new \View\V_Home();
// prove federico
global $config;
$array_foto = [];
for($i=1; $i<=16; $i++)
{
    array_push($array_foto, "templates/main/template/img/NoPhoto.jpg");

}
$avvia->assign('username',"testa di cazzo");
$avvia->assign('thumbnail',array_chunk($array_foto, PHOTOS_PER_ROW));
$avvia->display('home_default.tpl');
