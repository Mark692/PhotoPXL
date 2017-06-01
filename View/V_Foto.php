<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace View;

class V_Foto extends V_Home
{
    // METODI STATICI \\
    /**
     * Questo metodo viene utilizzato per vedere una foto, assegna a smarty 
     * i dati dell'utente e il percorso della foto
     * 
     * @param type $photo Description la foto con fullsize type e id
     * @param type $username 
     * 
     */
    public static function showPhotoPage($photo, $username)
    {
        $home = new \View\V_Home();
        //i dettagli di photo come titolo etc è un oggetto
        $home->assign('username', $username);
        $photo_details = $home->photo_details($photo);
        $cat = $home->imposta_categoria($photo_details['categories']);
        $home->assign('categories', $cat);
        $home->assign('photo_details', $photo_details);
        $home->showimage($photo);
        $home->assign('comments', \Entity\E_Comment::get_By_Photo($photo_details['id']));
        $likelist = $photo["photo"]->get_LikesList();
        foreach($likelist as $user)
        {
            //mi da errore dicendo che username non è definita
            if($user['username'] !== $username)
            {
                $home->assign('assegna', 'TRUE');
            }
        }
        $home->set_Cont_menu_user($home->imposta_ruolo(\Entity\E_User::get_DB_Role($username)));
        $home->set_Contenuto_Home($tpl = 'ShowPhotoUser');
        $home->display('home_default.tpl');
    }


    /**
     * Questo metodo viene utilizzato per richiamare il modulo di upload di una foto
     * @param type $username
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
     * mostra una vista per la modifica dei dati di una foto
     * @param type $photo Description la foto con fullsize type e id
     * @param type $username  
     */
    public static function showEditPhoto($photo, $username)
    {
        $home = new \View\V_Home();
        $home->assign('username', $username);
        $photo_details = $home->photo_details($photo);
        $home->assign('photo_details',$photo_details);
        $home->showimage($photo);
        $home->assign('categories', $home->imposta_categoria());
        $home->assign('role',\Entity\E_User::get_DB_Role($username));
        $home->set_Cont_menu_user($home->imposta_ruolo(\Entity\E_User::get_DB_Role($username)));
        $home->set_Contenuto_Home($tpl = 'EditPhoto');
        $home->display('home_default.tpl');
    }


    //METODI BASE - NON STATICI!!!\\

}