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


$username = "Fede";
$user_Watching="Fede";
$home=new \CaseUseView\CU_Home();
$home->standardhome($username);

//Home
/*
$home=new \CaseUseView\CU_Home();
$home->standardhome($username);
$home->notAllowed($username);
$home->banned();
$home->error($username);
$cats= Utilities\Categories::FAUNA;
$home->showPhotoCollection($username, $cats);//qua ci sta qualche cosa che non va dal databese riga 299...
$home->login();
$home->registration();
 *
 */


//Foto
/*
$foto=new \CaseUseView\CU_Foto();
$id = 7;
$foto->showPhotoPage($id, $username);
$foto->showEditPhoto($id, $username);
$foto->showUploadPhoto($username);
 *
 */


//Album
/*
$album=new \CaseUseView\CU_Album();
$id = 2;
$album->album($id, $username);
 *
 */


//Profilo
/**
$profilo=new \CaseUseView\CU_Profilo();
$user_Watching="Fede";
$profilo->home_profile($username, $user_Watching);
$profilo->banner($username);
$profilo->showEditProfile($username);
 *
 */


//Registazione
/*
$registrazione= new \CaseUseView\CU_Registration();
$registrazione->errorLogin();
$registrazione->errorRegistration();
 *
 */