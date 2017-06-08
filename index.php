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


$CU = new CaseUse\CU_Users();
$username = "Marco";
$password = "password";
$email = "email@mail.it";

$photo_ID = 7;
//$CU->registration($username, $password, $email);
//$CU->login($username, $password);
//$CU->manage_profilePIC($username, $photo_ID);
//$CU->aggiungi_Like($photo_ID, $username);
//$CU->rimuovi_Like($username, $photo_ID);
//$CU->upload_Status($username);
//$privacy = 0;
//$CU->set_Privacy($username, $photo_ID, $privacy);

//$pageToView = 1;
//$starts_With = "Mar";
//$limit_PerPage = 5;
//$CU->lista_Utenti($pageToView, $starts_With, $limit_PerPage);

//$CU->banna($username);
$CU->cambia_Ruolo("Fede", 3);
