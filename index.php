<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once ".".DIRECTORY_SEPARATOR."Includi".DIRECTORY_SEPARATOR."Autoloader.php";
require_once ".".DIRECTORY_SEPARATOR."Includi".DIRECTORY_SEPARATOR."config.inc.php";



global $config;
$user = "Username xXx";
$pass = "Password utente";
$email = "chiocciolalibero.eu@libero.it";
$uploads = 8;
$last_up = "21-04-2016";

for($role=0; $role<=count($config); $role++)
{
    $e_user = new \Entity\E_User($user, $pass, $email, $role, $uploads, $last_up);
    echo("Grado utente: ".$config['user'][$e_user->get_role()].nl2br("\r\n"));
    for($i=0; $i<14; $i++)
    {
        if ($e_user->can_upload())
        {
            echo("Totale ups: ".$e_user->get_up_Count().". ");
            $e_user->add_up_Count();
            echo("Pronto per l'upload Signore! Totale fatti: ".$e_user->get_up_Count().nl2br("\r\n"));
        }
        else
        {
            echo("GET REKT! Limite raggiunto: ".$e_user->get_up_Count()." per un utente ".$config['user'][$role].nl2br("\r\n"));
        }
    }
    echo(nl2br("\r\n"));
    unset($e_user);
}








//$avvia = new \View\V_Home();
