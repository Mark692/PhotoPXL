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
//session_start();
$avvia = new \View\V_Home();
$role= \Utilities\Roles::ADMIN;
$username="cazzo fritto";
$array_user=["username" => "cazzofritto", "password" => "tuozio",
"email"=>"cazzo@inculo.it","role"=>\Utilities\Roles::STANDARD];
$array_foto = [];
for($i=1; $i<=16; $i++)
{
    array_push($array_foto, "templates/main/template/img/img01.jpg");
    
}
$thumbnail=array_chunk($array_foto, PHOTOS_PER_ROW);
$immagine_profilo="templates/main/template/img/img01.jpg";
$avvia->bannedHome($username);
/*
 * $avvia->showProfile($array_user, $immagine_profilo,$thumbnail);
 */






//\Control\C_LoginRegistration::showHome();

//*
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

//var_dump(\Foundation\F_User::check_Token("AllUser", "014b0c8b902b075cdaa4a0f8b4849bc3d6dda66a56910e92a8f54ca628d02f96"));
        ?>