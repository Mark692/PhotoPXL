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

//$n = new View\V_Basic();


var_dump(dirname(__FILE__).DIRECTORY_SEPARATOR."templates".DIRECTORY_SEPARATOR."main".DIRECTORY_SEPARATOR."template".DIRECTORY_SEPARATOR."album.tpl");






echo(nl2br("\r\n"));
echo(nl2br("\r\n"));
echo(nl2br("\r\n"));
