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
//$test = new Prove\TF_Photo();
$id = 151;
var_dump(\Foundation\F_Album::get_By_ID($id));





//-----------------------------FINE-PROVE--------------------------//

//$avvia = new \View\V_Home();
