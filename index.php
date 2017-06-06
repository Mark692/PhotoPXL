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


$title = "Inverno";
$desc = "Foto di un paesaggio invernale";
$is_reserved = 0;
$cat = array(PAESAGGI);
$f= new \Entity\E_Photo($title, $desc, $is_reserved, $cat);
$bob = new \Entity\E_Photo_Blob();
$bob->on_Upload(".".DIRECTORY_SEPARATOR."Utilities".DIRECTORY_SEPARATOR."Install".DIRECTORY_SEPARATOR."1");
\Foundation\F_Photo::insert($f, $bob, "Marco");

$title = "Foto Orizzontale";
$desc = "Questa è una panoramica";
$is_reserved = 0;
$cat = array(PAESAGGI);
$f= new \Entity\E_Photo($title, $desc, $is_reserved, $cat);
$bob = new \Entity\E_Photo_Blob();
$bob->on_Upload(".".DIRECTORY_SEPARATOR."Utilities".DIRECTORY_SEPARATOR."Install".DIRECTORY_SEPARATOR."2");
\Foundation\F_Photo::insert($f, $bob, "Marco");

$title = "All'aperto";
$desc = "Foto con due alberi";
$is_reserved = 1;
$cat = array(PAESAGGI);
$f= new \Entity\E_Photo($title, $desc, $is_reserved, $cat);
$bob = new \Entity\E_Photo_Blob();
$bob->on_Upload(".".DIRECTORY_SEPARATOR."Utilities".DIRECTORY_SEPARATOR."Install".DIRECTORY_SEPARATOR."3");
\Foundation\F_Photo::insert($f, $bob, "Marco");

$title = "Tramonto rosso";
$desc = "Foto di un tramonto nuvoloso e molto rosso";
$is_reserved = 1;
$cat = array(PAESAGGI);
$f= new \Entity\E_Photo($title, $desc, $is_reserved, $cat);
$bob = new \Entity\E_Photo_Blob();
$bob->on_Upload(".".DIRECTORY_SEPARATOR."Utilities".DIRECTORY_SEPARATOR."Install".DIRECTORY_SEPARATOR."4");
\Foundation\F_Photo::insert($f, $bob, "Marco");

$title = "Fiume e Roccie";
$desc = "";
$is_reserved = 1;
$cat = array(PAESAGGI);
$f= new \Entity\E_Photo($title, $desc, $is_reserved, $cat);
$bob = new \Entity\E_Photo_Blob();
$bob->on_Upload(".".DIRECTORY_SEPARATOR."Utilities".DIRECTORY_SEPARATOR."Install".DIRECTORY_SEPARATOR."5");
\Foundation\F_Photo::insert($f, $bob, "Marco");

$title = "Lago Montagna Tramonto";
$desc = "Un paesaggio rurale al tramonto";
$is_reserved = 0;
$cat = array(PAESAGGI);
$f= new \Entity\E_Photo($title, $desc, $is_reserved, $cat);
$bob = new \Entity\E_Photo_Blob();
$bob->on_Upload(".".DIRECTORY_SEPARATOR."Utilities".DIRECTORY_SEPARATOR."Install".DIRECTORY_SEPARATOR."6");
\Foundation\F_Photo::insert($f, $bob, "Marco");

$title = "Frutta";
$desc = "";
$is_reserved = 0;
$cat = array(NATURAMORTA);
$f= new \Entity\E_Photo($title, $desc, $is_reserved, $cat);
$bob = new \Entity\E_Photo_Blob();
$bob->on_Upload(".".DIRECTORY_SEPARATOR."Utilities".DIRECTORY_SEPARATOR."Install".DIRECTORY_SEPARATOR."7");
\Foundation\F_Photo::insert($f, $bob, "Marco");

$title = "Tre frutti";
$desc = "Mela, arancia e pera";
$is_reserved = 0;
$cat = array(NATURAMORTA);
$f= new \Entity\E_Photo($title, $desc, $is_reserved, $cat);
$bob = new \Entity\E_Photo_Blob();
$bob->on_Upload(".".DIRECTORY_SEPARATOR."Utilities".DIRECTORY_SEPARATOR."Install".DIRECTORY_SEPARATOR."8");
\Foundation\F_Photo::insert($f, $bob, "Marco");

$title = "Frutta";
$desc = "Questa foto è privata";
$is_reserved = 1;
$cat = array(NATURAMORTA);
$f= new \Entity\E_Photo($title, $desc, $is_reserved, $cat);
$bob = new \Entity\E_Photo_Blob();
$bob->on_Upload(".".DIRECTORY_SEPARATOR."Utilities".DIRECTORY_SEPARATOR."Install".DIRECTORY_SEPARATOR."9");
\Foundation\F_Photo::insert($f, $bob, "Marco");

$title = "Natura Morta";
$desc = "foto o ritratto?";
$is_reserved = 0;
$cat = array(NATURAMORTA);
$f= new \Entity\E_Photo($title, $desc, $is_reserved, $cat);
$bob = new \Entity\E_Photo_Blob();
$bob->on_Upload(".".DIRECTORY_SEPARATOR."Utilities".DIRECTORY_SEPARATOR."Install".DIRECTORY_SEPARATOR."10");
\Foundation\F_Photo::insert($f, $bob, "Marco");

$title = "Tigre o Ghepardo?";
$desc = "Foto di fauna 1";
$is_reserved = 0;
$cat = array(FAUNA);
$f= new \Entity\E_Photo($title, $desc, $is_reserved, $cat);
$bob = new \Entity\E_Photo_Blob();
$bob->on_Upload(".".DIRECTORY_SEPARATOR."Utilities".DIRECTORY_SEPARATOR."Install".DIRECTORY_SEPARATOR."11");
\Foundation\F_Photo::insert($f, $bob, "Marco");

$title = "Famiglia di leoni";
$desc = "";
$is_reserved = 0;
$cat = array(FAUNA);
$f= new \Entity\E_Photo($title, $desc, $is_reserved, $cat);
$bob = new \Entity\E_Photo_Blob();
$bob->on_Upload(".".DIRECTORY_SEPARATOR."Utilities".DIRECTORY_SEPARATOR."Install".DIRECTORY_SEPARATOR."12");
\Foundation\F_Photo::insert($f, $bob, "Marco");

$title = "Volpe";
$desc = "Questa foto comprende sia Fauna che Paesaggi";
$is_reserved = 0;
$cat = array(FAUNA, PAESAGGI);
$f= new \Entity\E_Photo($title, $desc, $is_reserved, $cat);
$bob = new \Entity\E_Photo_Blob();
$bob->on_Upload(".".DIRECTORY_SEPARATOR."Utilities".DIRECTORY_SEPARATOR."Install".DIRECTORY_SEPARATOR."13");
\Foundation\F_Photo::insert($f, $bob, "Marco");

$title = "Gioiello farfalla";
$desc = "";
$is_reserved = 1;
$cat = array(FAUNA);
$f= new \Entity\E_Photo($title, $desc, $is_reserved, $cat);
$bob = new \Entity\E_Photo_Blob();
$bob->on_Upload(".".DIRECTORY_SEPARATOR."Utilities".DIRECTORY_SEPARATOR."Install".DIRECTORY_SEPARATOR."14");
\Foundation\F_Photo::insert($f, $bob, "Marco");

$title = "Pappagallo con sfondo";
$desc = "Questa foto comprende sia un elemento di fauna che un paesaggio";
$is_reserved = 1;
$cat = array(PAESAGGI, FAUNA);
$f= new \Entity\E_Photo($title, $desc, $is_reserved, $cat);
$bob = new \Entity\E_Photo_Blob();
$bob->on_Upload(".".DIRECTORY_SEPARATOR."Utilities".DIRECTORY_SEPARATOR."Install".DIRECTORY_SEPARATOR."15");
\Foundation\F_Photo::insert($f, $bob, "Marco");

$title = "Strada bianco nero";
$desc = "Foto di Street e BiancoNero";
$is_reserved = 0;
$cat = array(BIANCONERO, STREET);
$f= new \Entity\E_Photo($title, $desc, $is_reserved, $cat);
$bob = new \Entity\E_Photo_Blob();
$bob->on_Upload(".".DIRECTORY_SEPARATOR."Utilities".DIRECTORY_SEPARATOR."Install".DIRECTORY_SEPARATOR."16");
\Foundation\F_Photo::insert($f, $bob, "Marco");

$title = "Paesaggio in bianco e nero";
$desc = "";
$is_reserved = 1;
$cat = array(PAESAGGI, BIANCONERO);
$f= new \Entity\E_Photo($title, $desc, $is_reserved, $cat);
$bob = new \Entity\E_Photo_Blob();
$bob->on_Upload(".".DIRECTORY_SEPARATOR."Utilities".DIRECTORY_SEPARATOR."Install".DIRECTORY_SEPARATOR."17");
\Foundation\F_Photo::insert($f, $bob, "Marco");





//*
//$test_it = new \Utilities\installer();
//$test_it->set_DB_ConnectionParameters(); //Uncomment this to enable connection
//parameters with both: mine and standard ones (no pass, no user)

//NOTA: QUESTA FUNZIONE CERCHERA' DI CREARE E POPOLARE IL DATABASE "my_photopxl"
//$test_it->DB_FirstInstallation();

//Prove funzioni
//$test_it->try_Functions();
