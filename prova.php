<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$$smarty_path = ".".DIRECTORY_SEPARATOR."Utilities".DIRECTORY_SEPARATOR;
require_once $$smarty_path."Autoloader.php";
require_once $$smarty_path."config.inc.php";
require_once $$smarty_path."U_Nonce.php"; //SISTEMA QUESTE FUNZIONI IN UNA CLASSE COMPETENTE




//------------------------------PROVE------------------------------//
global $config;
$avvia = new \View\V_Basic();
$keys=array('username','password','email');
$array_dati=$avvia->get_Dati($keys);
$array_foto = [];
for($i=1; $i<=16; $i++)
{
    array_push($array_foto, "templates/main/template/img/NoPhoto.jpg");
    
}
$array_categories=["PAESAGGI", "STREET", "FAUNA","RITRATTI"];
$array_album=["title" => "le foto + belle", "description" => "ciaooooooooooooooooo",
    "is_reserved"=>"TRUE","categories"=>$array_categories];

$avvia->assign('array_album',$array_album);
$array_dati=["username" => "cazzofritto", "password" => "tuozio",
"email"=>"cazzo@inculo.it","role"=>"Standard"];
$avvia->assign('immagine_profilo',$foto);
$avvia->assign('ultime_foto',array_chunk($array_foto, PHOTOS_PER_ROW));
$avvia->assign('utente',$array_dati);
$avvia->display('home_default');