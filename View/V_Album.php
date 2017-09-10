<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace View;

/**
 * Questa classe gestisce le varie viste relative agli album
 */
class V_Album extends V_Home
{
    //METODI STATICI \\
    /**
     * Richiama il tpl per la vista dell'album, 
     * tramite smarty vengono assegnati i vari parametri al template
     * Viene fatto il controllo su $array_photo per vedere se sono presenti le thumbanil e assegnate a smarty
     * @param array $DB_album Oggetto Album per ricavare i dettagli 
     * @param array $array_photo
     *               How to access the array:
     *               - "id" => the photo's ID
     *               - "thumbnail" => its thumbnail
     *               - "type" => the user uploader
     *               - "tot_photo" => the number of photos
     * @param string $username L'utente che sta cercando di visualizzare l'album
     */
    public static function album($DB_album, $array_photo, $username)
    {
        $home = new \View\V_Home();
        $home->assign('username', $username);
        $album_details = $home->album_details($DB_album);
        $home->assign('album_details', $album_details);
        $home->assign('aid', $DB_album['album']->get_ID());
        $user_album = $DB_album['username'];
        $home->assign('user_album', $user_album);
        $home->assign('categories', $home->imposta_categoria($album_details['categories']));
        $home->CheckPhotos($array_photo);
        $home->assign('array_photo', $home->thumbnail($array_photo));
        $home->set_Cont_menu_user($home->imposta_ruolo(\Entity\E_User::get_DB_Role($username)));
        $home->set_Contenuto_Home($tpl = 'album');
        $home->display('home_default.tpl');
    }


    //METODI BASE - NON STATICI!!!\\


}