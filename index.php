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

$user = "AllUser";
$album1 = new \Entity\E_Album("Titolo a caso");
$album2 = new \Entity\E_Album("Titolo a 2");
$album3 = new \Entity\E_Album("Titolo 3");
$album4 = new \Entity\E_Album("Quattro");
//
$salva = array($album1, $album2, $album3, $album4);
//foreach($salva as $a)
//{
//    \Foundation\F_Album::insert($a, $user);
//}

$c1 = [1, 6, 4, 5, 2];
$c2 = [6];
$c3 = [1, 2, 3, 4, 7];
$c4 = [2, 5, 6];

$cats = array($c1, $c2, $c3, $c4);
foreach($cats as $k => $v)
{
    $salva[$k]->set_Categories($v);
    $salva[$k]->set_ID($k +1);
    $salva[$k]->set_Description("BLEEEEE");

    echo(nl2br("\r\n"));
    echo(nl2br("\r\n"));
    echo(nl2br("\r\n"));
}

\Foundation\F_Album::update_Details($album1);
    echo(nl2br("\r\n"));
    echo(nl2br("\r\n"));
    echo(nl2br("\r\n"));
//\Foundation\F_Album::update_Details($album2);
//    echo(nl2br("\r\n"));
//    echo(nl2br("\r\n"));
//    echo(nl2br("\r\n"));
//\Foundation\F_Album::update_Details($album3);
//    echo(nl2br("\r\n"));
//    echo(nl2br("\r\n"));
//    echo(nl2br("\r\n"));
//\Foundation\F_Album::update_Details($album4);






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
