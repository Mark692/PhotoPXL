<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once ".".DIRECTORY_SEPARATOR."Includi".DIRECTORY_SEPARATOR."Autoloader.php";
require_once ".".DIRECTORY_SEPARATOR."Includi".DIRECTORY_SEPARATOR."config.inc.php";


$nome = "marco";
$password = "unapssword";
$email = "mail";
$ruolo = 11111110;
$utente_prova = new \Entity\E_Utente($nome, $password, $email, $ruolo);

$provaDB = new \Foundation\F_Utente($nome);

echo $provaDB::set($utente_prova);



//echo $provaDB::get_by($nome);
//var_dump($provaDB::get_by($nome));
//print_r($provaDB::get_by($nome));

//return $provaDB::get_by($nome);












//$avvia = new \View\V_Home();
