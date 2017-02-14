<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$path = ".".DIRECTORY_SEPARATOR."Utilities".DIRECTORY_SEPARATOR;
require_once $path."Autoloader.php";
require_once $path."config.inc.php";
require_once $path."U_Nonce.php"; //SISTEMA QUESTE FUNZIONI IN UNA CLASSE COMPETENTE




//------------------------------PROVE------------------------------//
global $config;


$avvia = new \View\V_Basic();
$array_foto = [];
for($i=1; $i<=16; $i++)
{
    array_push($array_foto, "templates/main/template/img/NoPhoto.jpg");
    
}
$avvia->assign('ultime_foto',array_chunk($array_foto, PHOTOS_PER_ROW));
$avvia->display('diventa_pro.tpl');
//$array_dati=$avvia->get_Dati('username','password','email');
////$array_dati=["title" => "le foto + belle", "description" => "ciaooooooooooooooooo",
////    "is_reserved"=>"TRUE","categories"=>"STREET"];
////$array_categories=["PAESAGGI", "STREET", "FAUNA","RITRATTI"];
////$avvia->assign('array_categories',$array_categories);
//$array_dati=["username" => "cazzofritto", "password" => "tuozio",
//"email"=>"cazzo@inculo.it","role"=>"Standard"];
//$avvia->assign('immagine_profilo',$foto);
//$avvia->assign('ultime_foto',array_chunk($array_foto, PHOTOS_PER_ROW));
//$avvia->assign('utente',$array_dati);
//$avvia->display('profilo.tpl');
























//$test = new \Prove\TF_Album();
//$test->T_insert();
//$test->T_update();
//$test->T_getUser();
//$test->T_getCats();
//print_R(\Foundation\F_Album::get_Categories(1));


//$try = new Prove\TC_Registrazione();
//$try->save_User();



//$test_casoD_uso = new \Prove\TF_CaseUse();
//$test_casoD_uso->caso_d_uso();




//---Prova per TF_Comment---\\
//
//$testCommento = new \Prove\TF_Comment();
//$testCommento->insert();



//---Prova per TF_User---\\
//
//$provaFOUND = new \Prove\TF_User;
//$provaFOUND->insert_and_get();
//$provaFOUND->update();
//$user = new \Entity\E_User_PRO("username casuale", "pass cass", "mail@we.iti");
//var_dump($user);


//---Prova per E_Photo---\\
//
//$p_tryme = new \Prove\TE_Photo();
//$p_tryme->T_pconstr();


//---Prova per E_User()---\\
//
//$e_tryme = new \Prove\TE_User();
//$e_tryme->T_public_protected_private();
//$e_tryme->T_uconstr(); //Stampa gli utenti STD, PRO, MOD, Admin
//$e_tryme->T_SetGet();
//$e_tryme->T_Roles();
//$e_tryme->T_Data();
//$e_tryme->user_to_array();


//---Prova per U_Nonce()
//$n_tryme = new \Prove\TU_Nonce();
//$n_tryme->T_check();


echo(nl2br("\r\n"));





//-----------------------------FINE-PROVE--------------------------//

//$avvia = new \View\V_Home();
