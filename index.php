<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once ".".DIRECTORY_SEPARATOR."Includi".DIRECTORY_SEPARATOR."Autoloader.php";
require_once ".".DIRECTORY_SEPARATOR."Includi".DIRECTORY_SEPARATOR."config.inc.php";




$titolo = "Ciao, sono il titolo";
$desc = "ed io sono la descrizione :)";
$p_album = new \Entity\E_Album($titolo, $desc);

$album_no_desc = new \Entity\E_Album("Sono un altro titolo, ma niente descrizione");

echo ("Prova metodi get");
echo nl2br("\r\n");

echo $p_album->get_description();
echo nl2br("\r\n");
echo $p_album->get_title();

echo nl2br("\r\n");
echo nl2br("\r\n");

echo("Descrizione di seguito per album senza desc=");
echo $album_no_desc->get_description();
echo("...l'hai vista?");

echo nl2br("\r\n");
echo $album_no_desc->get_title();

echo nl2br("\r\n");
echo nl2br("\r\n Prova metodi set");

echo $p_album->set_description("Questa è una nuova descrizione");
echo $p_album->get_description();
echo nl2br("\r\n");
$nuovo_t = "Nuovo titolo impostato da variabile";
echo $p_album->set_title($nuovo_t);
echo $p_album->get_title();

echo nl2br("\r\n");
echo nl2br("\r\n");

echo $album_no_desc->set_description("Aggiunta di una descrizione ad un album senza desc iniziale");
echo $album_no_desc->get_description();
echo nl2br("\r\n");
echo $album_no_desc->set_title("Basta, ultimo tentativo");
echo $album_no_desc->get_title();

echo nl2br("\r\n");






//$avvia = new \View\V_Home();
