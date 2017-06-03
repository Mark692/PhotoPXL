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

//$role= \Entity\E_User::get_DB_Role($username);
$id="1";
//Entity\E_User::add_Like_to($id, $username);
//$thumb= \Entity\E_Photo::get_MostLiked($username, $role);
//var_dump($thumb);
$username= "Marco";
$user_details= \Entity\E_User::get_UserDetails($username='Fede');
$role= \Entity\E_User::get_DB_Role($username);
$DB_album= \Entity\E_Album::get_By_ID($id);
$array_photo= \Entity\E_Photo::get_By_Album($id, $username, $role);
\View\V_Home::notAllowed($array_photo, $username);

//$v->standardHome($array_photo, $username);


/**
$val=$home->imposta_categoria($cats);
var_dump($val);
$array_photo= \Entity\E_Photo::get_By_Categories($cats, $username, $role);
$home->assign('categoria',$val);
$home->display('prova.tpl');
//$home->showPhotoCollection($array_photo, $username,$cats);
/**
$username= "Fede";
$prova = new \P\prova();
        $title = $prova->rnd_str();
        $desc = $prova->rnd_str();
        $is_reserved = rand(0, 1);
        $cat = [];
        for($i = 0; $i < 6; $i++)
        {
            array_push($cat, rand(1, 8));
        }
        $cat = array_unique($cat);
        $up_Date = rand(1111, 6666);
        $f = new \Entity\E_Photo($title, $desc, $is_reserved, $cat, $up_Date);
$bob = new \Entity\E_Photo_Blob();
$percorso_foto="/Users/federicosantomero/Documents/PhotoPXL/NewFolder/PhotoPXL/templates/main/template/img/noimagefound.jpg";
$bob->on_Upload($percorso_foto);
var_dump($bob);
$username= "m86N4zW2ca";
$id="10";
$photos= \Entity\E_User::add_Like_to($id, $username);
 * \Entity\E_Photo::insert($f, $bob, $username)
 *
 */

//$test_it = new \Utilities\installer();
//$test_it->try_Functions();
/**$t= new P\photo();
for($i=1;$i<18;$i++)
{
    $t->INSERT($i);
}
 *
 */
//devo vede se  funziona quella delle thumbnail e cambiarla a tutte le parti do serve
//vedere le select multiple
//aggiustare il pulsante salva in modifica foto









/*


\Control\C_LoginRegistration::showHome();

//*
//------------------------------PROVE------------------------------//
$p=new P\photo();
$p->GET_MOSTLIKED();
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
