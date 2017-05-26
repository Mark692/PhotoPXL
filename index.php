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

//$test_it = new \Utilities\installer();
//$test_it->try_Functions();
$username= "cazzo";
$role= \Utilities\Roles::ADMIN;
//var_dump($foto);
//session_start();
$avvia=new \View\V_Basic();
$id="1";
$avvia->assign('username',$username);
$avvia->assign('role',$role);
$foto=\Entity\E_Photo::get_By_ID($id, $username, $role);
//$v=new View\show_image();
//$v->ShowImage($id=1, $username, $role);
$avvia->assign('type',$foto['type']);
$avvia->assign('fullsize',$foto['fullsize']);
$avvia->display('prova.tpl');

//$avvia->login();
/*
 * $role= \Utilities\Roles::ADMIN;
$user_datails=["username" => "cazzofritto", "password" => "tuozio",
"email"=>"cazzo@inculo.it","role"=>\Utilities\Roles::ADMIN];
$array_foto = [];

for($i=1; $i<=11; $i++)
{
    array_push($array_foto,"templates/main/template/img/img01.jpg");

}

$photo=["username"=>"cazzofritto","title"=>"porco crist","fullsize"=>"c/img/img01.jpg","categories"=>array("1"), "upload_date" => "01/03/05", "description" => "andatene a fanculo merde","is_reserved" =>"si"];
$pic_profile="templates/main/template/img/img01.jpg";
$comments=["1" => array("username"=>"cazz","text"=>"ciaooodiladfnlmfnaldnflnfa"),"2" => array("username"=>"ca333zz","text"=>"ciaooodiladfnlmfnaldnflnfa")];
$cat=$avvia->imposta_categoria($photo['categories']);
//echo($avvia->fetch_banner($tpl='banner_no_permessi'));
$avvia->showPhotoPage($photo, $user_datails, $comments);

// $avvia->showProfile($array_user, $immagine_profilo,$thumbnail);






\Control\C_LoginRegistration::showHome();

//*
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
 *
 */
?>
