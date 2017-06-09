<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Include Smarty
require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'libs'.DIRECTORY_SEPARATOR.'Smarty.class.php';

//Include autoloader and other functionalities
$path = ".".DIRECTORY_SEPARATOR."Utilities".DIRECTORY_SEPARATOR;
require_once $path."my_Autoloader.php";
require_once $path."config.inc.php";
require_once $path."U_Nonce.php";


$cu = new \CaseUse\CU_Albums();
$owner = "Marco";
$title = "Non mi piace questo ";
$desc = "e neanche la descrizione";
$cat = array(1, 3, 6, 7);
$creation_date = -12342;
//$cu->upload_it($owner, $title, $desc, $cat, $creation_date);

$id = 1;
//$cu->aggiorna_Dettagli($id, $title, $desc, $cat);

$photoID = 6;
//$cu->imposta_FotoCopertina($id, $photoID);

$page_toView = 1;
$order_DESC = FALSE;
//$cu->mostra_AlbumUtente($owner, $page_toView, $order_DESC);
//$cu->mostra_DettagliAlbum($id);
//$cu->mostra_perCategorie($cat, $page_toView, $order_DESC);
//$cu->elimina(3);
