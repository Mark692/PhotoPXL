<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace View;

/**
 * Questa classe gestisce le varie viste relative alle foto
 */
class V_Foto extends V_Home
{
    // METODI STATICI \\
    /**
     * Questa funzione assegna tramite smarty i vari parametri al tpl,
     * consente di richiamare un tpl che permette la vista di una foto,
     * assegna tramite smarty i commenti relativi alla foto
     *
     * @param array $photo 
     *               How to access the array:
     *               - "photo" => the photo's Entity Object
     *               - "uploader" => the user uploader
     *               - "fullsize" => the fullsize photo
     *               - "type" => its type
     * @param string $username L'utente che sta cercando di visualizzare la foto
     */
    public static function showPhotoPage($photo, $username)
    {
        $home = new View\V_Home();
        $home->assign('username', $username);
        $photo_details = $home->photo_details($photo);
        $cat = $home->imposta_categoria($photo_details['categories']);
        $home->assign('categories', $cat);
        $home->assign('photo_details', $photo_details);
        $home->showimage($photo);
        $home->assign('comments', \Entity\E_Comment::get_By_Photo($photo_details['id']));
        $likelist = $photo["photo"]->get_LikesList();
        var_dump($likelist);
        foreach($likelist as $user)
        {
            if($user['user'] !== $username)
            {
                $home->assign('assegna', 'TRUE');
            }
        }
        $home->set_Cont_menu_user($home->imposta_ruolo(\Entity\E_User::get_DB_Role($username)));
        $home->set_Contenuto_Home($tpl = 'ShowPhotoUser');
        $home->display('home_default.tpl');
    }


    /**
     * Questa funzione viene utilizzata per richiamare il modulo di upload di una foto
     * 
     * @param string $username L'utente che vuole effettuare l'upload delle foto
     */
    public static function showUploadPhoto($username)
    {
        $home = new \View\V_Home();
        if(\Entity\E_User::get_DB_Role($username) === \Utilities\Roles::STANDARD)
        {
            $tpl = 'upload_standard';
        }
        else
        {
            $tpl = 'upload';
        }
        $home->assign('username', $username);
        $home->assign('categories', $home->imposta_categoria());
        $home->set_Cont_menu_user($home->imposta_ruolo(\Entity\E_User::get_DB_Role($username)));
        $home->set_Contenuto_Home($tpl);
        $home->display('home_default.tpl');
    }


    /**
     * Questa funzione assegna tramite smarty i vari parametri al tpl,
     * consente di richiamare un tpl che permette la modifica dei vari dettagli della foto
     * 
     * @param array $photo 
     *               How to access the array:
     *               - "photo" => the photo's Entity Object
     *               - "uploader" => the user uploader
     *               - "fullsize" => the fullsize photo
     *               - "type" => its type
     * @param string $username L'utente che sta cercando di visualizzare la foto
     *
     */
    public static function showEditPhoto($photo, $username)
    {
        $home = new \View\V_Home();
        $home->assign('username', $username);
        $photo_details = $home->photo_details($photo);
        $home->assign('photo_details', $photo_details);
        $home->showimage($photo);
        $home->assign('categories', $home->imposta_categoria());
        $home->assign('role', \Entity\E_User::get_DB_Role($username));
        $home->set_Cont_menu_user($home->imposta_ruolo(\Entity\E_User::get_DB_Role($username)));
        $home->set_Contenuto_Home($tpl = 'EditPhoto');
        $home->display('home_default.tpl');
    }


    //METODI BASE - NON STATICI!!!\\
}