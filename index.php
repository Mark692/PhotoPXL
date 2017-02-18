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
echo(nl2br("\r\n"));

$test = new Prove\TF_Photo();
$test->t_countPages();





















//
//
//$avvia=new View\V_Basic();
//$array_foto = [];
//for($i=1; $i<=16; $i++)
//{
//    array_push($array_foto, "templates/main/template/img/NoPhoto.jpg");
//
//}
//$array_categories=["PAESAGGI", "STREET", "FAUNA","RITRATTI"];
//$array_album=["title" => "albumo figo", "description" => "quante belle foto che si vedono qui",
//    "is_reserved"=>"FALSE","categories"=>$array_categories];
////$array_categories=["PAESAGGI", "STREET", "FAUNA","RITRATTI"];
////$avvia->assign('array_categories',$array_categories);
//$avvia->assign('dati_album',$array_album);
//$avvia->assign('thumbnail',array_chunk($array_foto, PHOTOS_PER_ROW));
//$avvia->display('album.tpl');
//$session= new \Utilities\U_Session();
//$session->set_Val('username', 'ciao');
//$session->set_Val('role', Utilities\Roles::ADMIN);
//$C_Home= new \Control\C_Home;
//$C_Home->Set_home();




//-----------------------------FINE-PROVE--------------------------//

//$avvia = new \View\V_Home();
