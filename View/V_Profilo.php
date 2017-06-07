<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * @access public
 * @package View
 */

namespace View;

/**
 * questa classe consete di gestire le varie viste relative al Profilo
 */
class V_Profilo extends V_Home
{
    /*
     * Funzione che restiuisce il template del profilo nel quale sono presenti 
     * le thumbnail delle foto/album di un determinato utente e le sue informazioni
     * e la sua immagine di profilo 
     *
     * @param type $username  L'untente che sta cercando di visualizzare il profilo
     * @param objet $user_details  \Entity\E_User_* The user searched
     * @param array $array_photo thumbnail delle foto/album di un determinato utente
     *               How to access the array:
     *               - "id" => the photo's ID
     *               - "thumbnail" => its thumbnail
     *               - "type" => the user uploader
     *               - "tot_photo" => the number of photos
     */
    public static function home($username, $user_details, $array_photo)
    {
        $home = new \View\V_Home();
        $details = $home->user_details($user_details);
        $home->assign('user_details', $details);
        $home->show_profile_pic(\Entity\E_User::get_ProfilePic($details['username']));
        $home->assign('username', $username);
        if($username === $details['username'])
        {
            $home->assign('attiva', TRUE);
        }
        $home->CheckPhotos($array_photo);
        $home->set_Cont_menu_user($home->imposta_ruolo(\Entity\E_User::get_DB_Role($username)));
        $home->set_Contenuto_Home($tpl = 'ShowProfile');
        $home->display('home_default.tpl');
    }


    /*
     * mostra la home page con messsaggio di successo = Azione avvenuta correttamente'
     *
     * @param array $array_photo array con ID e Thumbnails che hanno più like.
     *               How to access the array:
     *               - "id" => the photo's ID
     *               - "thumbnail" => it's thumbnail
     *               - "type" => the user uploader
     *               - "tot_photo" => the number of photos
     * @param string $username L'utente che sta cercando di visualizzare la pagina
     */
    public static function banner($array_photo, $username)
    {
        $home = new V_Home();
        $home->set_banner($tpl = 'banner_ok');
        $home->assign('username', $username);
        $home->CheckPhotos($array_photo);
        $home->assign('categories', $home->imposta_categoria());
        $home->set_Cont_menu_user($home->imposta_ruolo(\Entity\E_User::get_DB_Role($username)));
        $home->set_Contenuto_Home($home->set_home($username));
        $home->display('home_default.tpl');
    }


    /**
     * ritorna una vista che consente la modifica dei dati utente
     *
     * @param objet $user_details  \Entity\E_User_* The user searched
     * @param array $array_photo array con ID e Thumbnails che hanno più like.
     *               How to access the array:
     *               - "id" => the photo's ID
     *               - "thumbnail" => it's thumbnail
     *               - "type" => the user uploader
     *               - "tot_photo" => the number of photos
     */
    public static function showEditProfile($user_details, $array_photo)
    {
        $home = new \View\V_Home();
        $details = $home->user_details($user_details);
        $home->assign('user_details', $details);
        $home->show_profile_pic(\Entity\E_User::get_ProfilePic($details['username']));
        $home->assign('username', $details['username']);
        $home->CheckPhotos($array_photo);
        $home->set_Cont_menu_user($details['role']);
        $home->set_Contenuto_Home($tpl = 'EditProfile');
        $home->display('home_default.tpl');
    }


    //METODI BASE - NON STATICI!!!\\
}