<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once ".".DIRECTORY_SEPARATOR."Includi".DIRECTORY_SEPARATOR."Autoloader.php";
require_once ".".DIRECTORY_SEPARATOR."Includi".DIRECTORY_SEPARATOR."config.inc.php";

global $config;


//------------------------------PROVE------------------------------//
$tryme = new \Prove\P_User();
$obj = $tryme->rnd_E_User(); //Crea un utente con dati casuali

//var_dump($obj);
//echo(nl2br("\r\n"));
echo(nl2br("\r\n"));

//Visualizza l'oggetto $obj in forma di array
$ref = new \ReflectionClass($obj);
foreach((array) $obj as $field=>$value)
{
    $field = str_replace($ref->getName(), '', $field); //Rimozione di Namespace/Class da ogni $field
    $field = filter_var($field, FILTER_SANITIZE_STRING); //Rimuove i caratteri non voluti

    echo(ucfirst($field)." = ".$value.nl2br("\r\n"));
}

$hashit = $obj->get_last_Upload().$obj->get_username().$obj->get_password();
echo("HashIT = ".$hashit);
echo(nl2br("\r\n"));
echo(nl2br("\r\n"));
echo("Hash md4 = ".hash('md4', $hashit));






//$avvia = new \View\V_Home();
