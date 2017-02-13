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

$test = new \Prove\TF_Album();
//$test->T_insert();
//$test->T_update();
//$test->T_getUser();
//$test->T_getCats();
print_R(\Foundation\F_Album::get_Categories(1));







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
