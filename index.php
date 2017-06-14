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


$photo = new \CaseUse\CU_Photos();
$id = 11;
$user_Watching = "Marco";
$user_Role = 2; //Questo può essere anche:
//$user_Role = \Foundation\F_User::get_Role($user_Watching); //in modo da non bypassare il DB
$order_DESC = FALSE;
//$photo->mostra_FULL($id, $user_Watching, $user_Role, $order_DESC);




//Users
/*
 * Registrazione_Login($username, $password, $email)
 * manage_profilePIC($username, $photo_ID, $path)
 * insert($username, $password, $email)
 * get_LoginInfo($username, $password)
 * get_ProfilePic($username)
 * set_ProfilePic($username, $photo_ID)
 * $percorso = ".".DIRECTORY_SEPARATOR."Utilities".DIRECTORY_SEPARATOR."Install".DIRECTORY_SEPARATOR;
 * $nome_Foto = "marco";
 * $percorso_foto = $percorso.$nome_Foto;
 * upload_NewCover($username, $percorso_foto)
 * remove_CurrentProPic($username)
 * add_Like_to($photo_ID, $username)
 * remove_Like($username, $photo_ID)
 * can_Upload($username)
 * set_PhotoPrivacy($username, $photo_ID, $privacy)
 * get_UsersList($pageToView = 1, $starts_With = '', $limit_PerPage = 10)
 * ban($username)
 * change_Role($username, $nuovo_Ruolo)
 *
 */



//Photos
/*
 * insert($title, $desc, $is_reserved, $cat, $path, $uploader)
 * update_Details($ID, $title, $desc, $is_reserved, $cat)
 * get_By_User($uploader, $user_Watching, $user_Role, $page_toView = 1, $order_DESC = FALSE)
 * mostra_FULL($id, $user_Watching, $user_Role, $order_DESC)
 * get_By_ID($id, $user_Watching, $user_Role)
 * get_By_Categories($cats, $user_Watching, $user_Role, $page_toView = 1, $order_DESC = FALSE)
 * get_LikeList($ID)
 * get_MostLiked($user_Watching, $user_Role, $page_toView)
 * get_By_Album($album_ID, $user_Watching, $user_Role, $page_toView = 1, $order_DESC = FALSE)
 * move_To($photo_ID, $album_ID)
 * delete($photo_ID)
 *
 */



//Albums
/*
 * insert($owner, $title, $desc, $cat)
 * update_Details($id, $title, $desc, $cat)
 * set_Cover($albumID, $photoID)
 * get_By_User($owner, $page_toView, $order_DESC)
 * get_By_ID($id)
 * get_By_Categories($cats, $page_toView, $order_DESC)
 * delete($id)
 * delete_Album_AND_Photos($album_ID)
 *
 */


//Comments
/*
 * insert($testo, $utente, $photoID)
 * get_By_Photo($photo_ID, $order_DESC)
 * update($id, $testo, $utente, $photoID)
 * remove($id)
 *
 */