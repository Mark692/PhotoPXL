<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$path = ".".DIRECTORY_SEPARATOR."Utilities".DIRECTORY_SEPARATOR;
require_once $path."Autoloader.php";
require_once $path."config.inc.php";
//require_once $path."U_Nonce.php";


//------------------------------PROVE------------------------------//

//NOTA: QUESTA FUNZIONE CERCHERA' DI POPOLARE IL DATABASE "my_photopxl"
//USALA PER POTER AVERE TUTTO ENTITY E FOUNDATION FUNZIONANTI.
//
//PER CONTROLLARE LE VARIE FUNZIONI, COME AGISCONO, CHE DATI PRENDONO IN INPUT ECC
//VAI IN \P\ e SCEGLI UN FILE. SONO CONTENUTE PROVE PER TUTTE LE FUNZIONI DI FOUNDATION
//UTILIZZANDO OGGETTI ENTITY E PRESI DAL DB.
//$i = new Utilities\installer();
//$i->DB_FirstInstallation();


//Prove funzioni
//echo(nl2br("\r\n"));
//echo(nl2br("\r\n"));
//echo(nl2br("\r\n"));
//$test_it = new \Utilities\installer();
//$test_it->try_Functions();
global $config;
$avvia = new \View\V_Basic();
$thumbnail = [];
for($i=1; $i<=16; $i++)
{
    array_push($thumbnail, "templates/main/template/img/logo.png");
    
}
$commento=["ciao cazzo","porco qua","porco la"];
$utente=["io","tu","egli"];
$commenti=["utente"=>$utente,"commenti"=>$commento];
$array_categories=["PAESAGGI", "STREET", "FAUNA","RITRATTI"];
$array_foto=["title" => "le foto + belle", "description" => "ciaooooooooooooooooo",
    "is_reserved"=>"TRUE","categories"=>"fauna","total_like"=>"10","upload_date"=>"3 dicembre",
    "name_album"=>"fregno", "fullsize"=>$thumbnail[0]];
$avvia->assign('thumbnail',array_chunk($thumbnail, PHOTOS_PER_ROW));
$avvia->assign('dati_foto',$array_foto);
$avvia->assign('commenti',$commenti);
$avvia->assign('attiva','FALSE');
$avvia ->display('home_default.tpl');

//var_dump(\Foundation\F_User::check_Token("AllUser", "014b0c8b902b075cdaa4a0f8b4849bc3d6dda66a56910e92a8f54ca628d02f96"));
















echo(nl2br("\r\n"));
echo(nl2br("\r\n"));
echo(nl2br("\r\n"));
